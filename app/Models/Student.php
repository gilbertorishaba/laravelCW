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
        'course_id',
        'phone',
        'dob',
        'profile_image_url'
    ];

    // Enable automatic timestamps
    public $timestamps = true;

    // Accessor for profile image URL
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image_url ? asset('storage/' . $this->profile_image_url) : null;
    }

    // Many-to-Many relationship between students and courses
    public function course()
    {
        return $this->belongsTo(Course::class);
    }



}
