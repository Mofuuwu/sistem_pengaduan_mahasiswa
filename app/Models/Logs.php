<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    /** @use HasFactory<\Database\Factories\LogsFactory> */
    use HasFactory;
    protected $guarded = [];
    public function complaint() {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
