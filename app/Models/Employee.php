<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
    protected $guarded = [];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function logs() {
        return $this->hasMany(Logs::class, 'employee_id');
    }
}
