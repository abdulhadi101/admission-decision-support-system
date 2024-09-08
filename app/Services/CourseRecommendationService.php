<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Applicant;

class CourseRecommendationService
{
    private $gradePoints = [
        'A1' => 1.0, 'B2' => 0.9, 'B3' => 0.8, 'C4' => 0.7, 'C5' => 0.6,
        'C6' => 0.5, 'D7' => 0.4, 'E8' => 0.3, 'F9' => 0.0
    ];

    public function getRecommendations(Applicant $applicant, $limit = 3)
    {
        $courses = Course::with('requirements')->get();

        $recommendations = $courses->map(function ($course) use ($applicant) {
            $score = $this->calculateFitScore($applicant, $course);
            $meetsRequirements = $this->checkCourseRequirements($applicant, $course);
            return [
                'course' => $course,
                'score' => $score,
                'meetsRequirements' => $meetsRequirements,
            ];
        })->sortByDesc('score')
          ->filter(function ($recommendation) {
              return $recommendation['meetsRequirements'];
          })
          ->take($limit);

        return $recommendations;
    }

    private function calculateFitScore(Applicant $applicant, Course $course)
    {
        $jambScore = $this->normalizeJambScore($applicant->jamb_score);
        $oLevelScore = $this->calculateWeightedOLevelScore($applicant, $course);

        $fitScore = 
            ($jambScore * $course->jamb_weight) +
            ($oLevelScore * $course->o_level_weight);

        return $fitScore;
    }

    private function normalizeJambScore($score)
    {
        return $score / 400; // Assuming JAMB score is out of 400
    }

    private function calculateWeightedOLevelScore(Applicant $applicant, Course $course)
    {
        $totalWeightedPoints = 0;
        $totalWeight = 0;

        foreach ($course->requirements as $requirement) {
            $result = $applicant->oLevelResults->firstWhere('subject', $requirement->subject);
            if ($result) {
                $gradePoint = $this->gradePoints[$result->grade] ?? 0;
                $totalWeightedPoints += $gradePoint * $requirement->weight;
                $totalWeight += $requirement->weight;
            }
        }

        // Calculate score for subjects not specifically required but still relevant
        $remainingSubjects = $applicant->oLevelResults->whereNotIn('subject', $course->requirements->pluck('subject'));
        foreach ($remainingSubjects as $result) {
            $gradePoint = $this->gradePoints[$result->grade] ?? 0;
            $totalWeightedPoints += $gradePoint * 0.5; // Use a lower weight for non-required subjects
            $totalWeight += 0.5;
        }

        return $totalWeight > 0 ? $totalWeightedPoints / $totalWeight : 0;
    }

    private function checkCourseRequirements(Applicant $applicant, Course $course)
    {
        foreach ($course->requirements as $requirement) {
            $result = $applicant->oLevelResults->firstWhere('subject', $requirement->subject);
            if (!$result || !$this->isGradeSufficient($result->grade, $requirement->minimum_grade)) {
                return false;
            }
        }
        return true;
    }

    private function isGradeSufficient($actualGrade, $requiredGrade)
    {
        $grades = array_keys($this->gradePoints);
        return array_search($actualGrade, $grades) <= array_search($requiredGrade, $grades);
    }
}