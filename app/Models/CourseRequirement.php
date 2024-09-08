<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRequirement extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'minimum_grade', 'weight'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
