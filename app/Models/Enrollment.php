<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    // Define which attributes can be mass assigned
    protected $fillable = [
        'student_id',        // Foreign key referencing students table
        'course_id',         // Foreign key referencing courses table
        'enrollment_date',   // Enrollment date
        'status',            // Status (active, completed, etc.)
        'grade',             // Grade (nullable)
    ];

    // Define relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Define relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
