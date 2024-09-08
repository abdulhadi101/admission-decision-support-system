<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Course;
use App\Models\OLevelResult;
use App\Services\CourseRecommendationService;

class ApplicantProfileController extends Controller
{
    protected $recommendationService;

    public function __construct(CourseRecommendationService $recommendationService)
    {
        $this->middleware('auth');
        $this->recommendationService = $recommendationService;
    }

    public function show()
    {
        $applicant = auth()->user()->applicant;
        $courses = Course::all();
        $oLevelResults = $applicant->oLevelResults;
        $recommendations = collect();

        if ($applicant->jamb_score && $oLevelResults->count() >= 5) {
            $recommendations = $this->recommendationService->getRecommendations($applicant);
        }

        return view('applicant.profile', compact('applicant', 'courses', 'oLevelResults', 'recommendations'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jamb_score' => 'required|numeric|min:0|max:400',
            'course_id' => 'required|exists:courses,id',
            'o_level_results' => 'required|array|min:5|max:8',
            'o_level_results.*.subject' => 'required|string',
            'o_level_results.*.grade' => 'required|in:A1,B2,B3,C4,C5,C6,D7,E8,F9',
        ]);

        $applicant = auth()->user()->applicant;
        $applicant->update($request->only(['jamb_score', 'course_id']));

        // Delete existing O-level results and add new ones
        $applicant->oLevelResults()->delete();
        foreach ($request->o_level_results as $result) {
            $applicant->oLevelResults()->create($result);
        }

        return redirect()->route('applicant.profile')->with('success', 'Profile updated successfully');
    }
}