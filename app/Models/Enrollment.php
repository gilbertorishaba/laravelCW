<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'course_name',
        'enrollment_date',
        'status',
    ];

    // Define relationships if needed, for example:
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
