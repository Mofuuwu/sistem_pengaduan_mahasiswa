<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    /** @use HasFactory<\Database\Factories\StudyProgramFactory> */
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function college_students()
    {
        return $this->hasMany(CollegeStudent::class);
    }
}
