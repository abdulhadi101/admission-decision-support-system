<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
    public function applicantsApproved()
    {
        return $this->hasMany(Applicant::class, 'approved_course_id');
    }
    public function requirements()
    {
        return $this->hasMany(CourseRequirement::class);
    }
}
