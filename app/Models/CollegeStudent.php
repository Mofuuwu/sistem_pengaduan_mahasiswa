<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeStudent extends Model
{
    /** @use HasFactory<\Database\Factories\CollegeStudentFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'nim';
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
