<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function approvedCourse()
    {
        return $this->belongsTo(Course::class, 'approved_course_id');
    }

    public function level()
    {
        return $this->hasMany(OLevelResult::class);
    }
}
