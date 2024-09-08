<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'name' => 'Computer Science',
                'jamb_weight' => 0.7,
                'o_level_weight' => 0.2,
                'interview_weight' => 0.1,
            ],
            [
                'name' => 'Electrical Engineering',
                'jamb_weight' => 0.6,
                'o_level_weight' => 0.3,
                'interview_weight' => 0.1,
            ],
            [
                'name' => 'Medicine',
                'jamb_weight' => 0.5,
                'o_level_weight' => 0.3,
                'interview_weight' => 0.2,
            ],
            [
                'name' => 'Economics',
                'jamb_weight' => 0.6,
                'o_level_weight' => 0.3,
                'interview_weight' => 0.1,
            ],
            [
                'name' => 'Law',
                'jamb_weight' => 0.5,
                'o_level_weight' => 0.3,
                'interview_weight' => 0.2,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
