<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Applicant;
use App\Models\OlevelResult;
use App\Services\CourseRecommendationService;
use Illuminate\Support\Facades\Auth;


class AdmissionForm extends Component
{   public $jambScore;
    public $selectedCourse;
    public $subjects = [];
    public $grades = [];
    public $examBoards = [];
    public $recommendations = [];

    protected $rules = [
        'jambScore' => 'required|numeric|min:0|max:400',
        'selectedCourse' => 'required|exists:courses,id',
        'subjects.*' => 'required|string',
        'grades.*' => 'required|in:A1,B2,B3,C4,C5,C6,D7,E8,F9',
        'examBoards.*' => 'required|string',
    ];

    protected $recommendationService;

    public function boot(CourseRecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function mount()
    {
        $this->subjects[] = '';
        $this->grades[] = '';
        $this->examBoards[] = '';

        $applicant = Auth::user()->applicant;
        if ($applicant) {
            $this->jambScore = $applicant->jamb_score;
            $this->selectedCourse = $applicant->course_id;
            
            foreach ($applicant->oLevelResults as $result) {
                $this->subjects[] = $result->subject;
                $this->grades[] = $result->grade;
                $this->examBoards[] = $result->exam_board;
            }
        }
    }

    public function addSubject()
    {
        $this->subjects[] = '';
        $this->grades[] = '';
        $this->examBoards[] = '';
    }

    public function removeSubject($index)
    {
        unset($this->subjects[$index]);
        unset($this->grades[$index]);
        unset($this->examBoards[$index]);
        $this->subjects = array_values($this->subjects);
        $this->grades = array_values($this->grades);
        $this->examBoards = array_values($this->examBoards);
    }

    public function submitApplication()
    {
        $this->validate();

        $applicant = Auth::user()->applicant ?? new Applicant();
        $applicant->user_id = Auth::id();
        $applicant->jamb_score = $this->jambScore;
        $applicant->course_id = $this->selectedCourse;
        $applicant->save();

        // Delete existing O-level results and add new ones
        $applicant->oLevelResults()->delete();
        foreach ($this->subjects as $index => $subject) {
            OlevelResult::create([
                'applicant_id' => $applicant->id,
                'subject' => $subject,
                'grade' => $this->grades[$index],
                'exam_board' => $this->examBoards[$index],
            ]);
        }

        $this->getRecommendations();

        session()->flash('message', 'Application submitted successfully!');
    }

    public function getRecommendations()
    {
        $applicant = Auth::user()->applicant;
        if ($applicant && $applicant->jamb_score && count($applicant->oLevelResults) >= 5) {
            $this->recommendations = $this->recommendationService->getRecommendations($applicant);
        }
    }

    public function render()
    {
        return view('livewire.admission-form', [
            'courses' => Course::all(),
        ]);
    }
}
