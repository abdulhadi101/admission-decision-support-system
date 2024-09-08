<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Course;

class SAWCalculator
{
    public function calculateScore(Applicant $applicant)
    {
        $course = $applicant->course;

        $normalizedJambScore = $this->normalize($applicant->jamb_score, 0, 400);
        $normalizedOLevelScore = $this->normalize($applicant->o_level_score, 0, 100);
        $normalizedInterviewScore = $this->normalize($applicant->interview_score, 0, 100);

        $sawScore = 
            ($normalizedJambScore * $course->jamb_weight) +
            ($normalizedOLevelScore * $course->o_level_weight) +
            ($normalizedInterviewScore * $course->interview_weight);

        return $sawScore;
    }

    private function normalize($value, $min, $max)
    {
        return ($value - $min) / ($max - $min);
    }
}