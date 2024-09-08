<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jamb_weight',
        'o_level_weight',
        'interview_weight',
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function requirements()
    {
        return $this->hasMany(CourseRequirement::class);
    }
}
