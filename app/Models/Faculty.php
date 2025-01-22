<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /** @use HasFactory<\Database\Factories\FacultyFactory> */
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class);
    }
    public function college_students()
    {
        return $this->hasMany(CollegeStudent::class);
    }
}
