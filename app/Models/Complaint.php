<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    /** @use HasFactory<\Database\Factories\ComplaintFactory> */
    use HasFactory;
    protected $guarded = [];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function logs() {
        return $this->hasMany(Logs::class, 'complaint_id');
    }
    public function supports() {
        return $this->hasMany(Support::class, 'complaint_id');
    }
    public function attachments() {
        return $this->hasMany(Attachment::class, 'complaint_id', 'id');
    }
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
