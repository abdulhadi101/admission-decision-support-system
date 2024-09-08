<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Course;
use App\Services\SAWCalculator;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    private $sawCalculator;

    public function __construct(SAWCalculator $sawCalculator)
    {
        $this->sawCalculator = $sawCalculator;
    }

    public function calculateScores()
    {
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $sawScore = $this->sawCalculator->calculateScore($applicant);
            $applicant->update(['saw_score' => $sawScore]);
        }

        return redirect()->back()->with('success', 'SAW scores calculated successfully.');
    }

    public function showRanking(Course $course)
    {
        $rankedApplicants = $course->applicants()
            ->orderByDesc('saw_score')
            ->get();

        return view('admission.ranking', compact('course', 'rankedApplicants'));
    }
}