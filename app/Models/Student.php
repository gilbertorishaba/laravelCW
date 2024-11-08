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
        'course_id', // Single course relationship
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

    // Uncomment if you need to access a single course via `course_id`
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

//     // Many-to-Many relationship between students and courses
//     public function courses()
//     {
//         return $this->belongsToMany(Course::class)
//                     ->withPivot('enrollment_date', 'status', 'grade');
//     }
 }
