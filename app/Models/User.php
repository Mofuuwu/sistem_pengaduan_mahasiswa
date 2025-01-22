<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    public function complaints() {
        return $this->hasMany(Complaint::class, 'user_id');
    }
    public function supports() {
        return $this->hasMany(Support::class, 'user_id');
    }
    public function college_student() {
        return $this->hasOne(CollegeStudent::class, 'user_id');
    }
    public function employee() {
        return $this->hasOne(Employee::class, 'user_id');
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
