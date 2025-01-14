<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /** @use HasFactory<\Database\Factories\AttachmentFactory> */
    use HasFactory;
    protected $guarded = [];
    public function complaint() {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
}
