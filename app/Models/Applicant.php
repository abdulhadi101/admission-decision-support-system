<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static function booted()
    {
        static::addGlobalScope('withUser', function (Builder $builder) {
            $builder->with('user');
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

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
