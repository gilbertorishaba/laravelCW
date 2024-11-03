<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'course_enrolled',
        'phone',
        'dob',
        'profile_image_url' // Added profile_image_url to fillable array
    ];

    // Enable automatic timestamps (if you want to track created_at and updated_at)
    public $timestamps = true; // Set this to false if you don't want timestamps

    // Accessor for profile image URL
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image_url ? asset('storage/' . $this->profile_image_url) : null;
    }
}
