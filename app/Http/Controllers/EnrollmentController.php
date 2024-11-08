<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    // Method to show the enrollment form
    public function showEnrollmentForm(Request $request)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin !== 1) {
            return redirect()->route('welcome')->with('error', 'Unauthorized access');
        }

        // Fetch the course based on the course ID passed in the request (e.g., ?course=1)
        $courseId = $request->query('course');
        $course = Course::findOrFail($courseId);

        // Fetch all students to display in the enrollment form
        $students = Student::all();

        // Pass the course and students to the view
        return view('admin.enroll', compact('course', 'students'));
    }

    // Method to enroll a student in a course (POST request)
    public function store(Request $request)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin !== 1) {
            return redirect()->route('welcome')->with('error', 'Unauthorized access');
        }

        // Validate the incoming data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'dob' => 'required|date',
            'phone' => 'required',
            'status' => 'required|string',
            'grade' => 'nullable|string|max:10',
        ]);

        // Check if student already exists, if not, create a new one
        $student = Student::firstOrNew(['email' => $request->email]);
        $student->name = $request->name;
        $student->dob = $request->dob;
        $student->phone = $request->phone;

        // Save the student information
        $student->save();

        // Enroll the student in the course
      // Enroll the student in the course
$student->course()->associate(Course::find($request->course_id)); // Associate course with the student
$student->enrollment_date = $request->enrollment_date;
$student->status = $request->status;
$student->grade = $request->grade;
$student->save();


        // Redirect to the enroll page with success message
        return redirect()->route('admin.enroll')->with('success', 'Student enrolled successfully!');
    }

    // Method to view enrollments for a particular course
    public function viewEnrollments(Course $course)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin !== 1) {
            return redirect()->route('welcome')->with('error', 'Unauthorized access');
        }

        // Get all students enrolled in the course (using the relation defined in the Course model)
        $students = $course->students;
        $allStudents = Student::all();

        // Pass all students to the view
        return view('admin.courses.students', compact('course', 'students', 'allStudents'));
    }
}
