<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jamb_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function oLevelResults()
    {
        return $this->hasMany(OLevelResult::class);
    }
}
