<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OlevelResult extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'grade', 'exam_board'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
