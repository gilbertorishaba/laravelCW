<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Display the list of students
    public function index()
    {
        // Load students with their associated course
        $students = Student::with('course')->get();
        return view('backend.students.index', compact('students'));
    }

    // Show the form for creating a new student
    public function create()
    {
        $courses = Course::all(); // Fetch all courses to display in the dropdown
        return view('backend.students.create', compact('courses'));
    }

    // Store a new student
    public function store(Request $request)
    {
        // Log incoming request data for debugging
        \Log::info($request->all());

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'profile_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle profile image upload
        $imagePath = null;
        if ($request->hasFile('profile_image_url')) {
            $imagePath = $request->file('profile_image_url')->store('images/students', 'public');
        }

        // Create a new student with the validated data
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'course_id' => $request->course_id,
            'profile_image_url' => $imagePath,
        ]);

        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // Display a specific student
    public function show(Student $student)
    {
        // Load the associated course for the student
        return view('backend.students.show', compact('student'));
    }

    // Show the form for editing a student
    public function edit(Student $student)
    {
        $courses = Course::all(); // Fetch all courses for the dropdown
        return view('backend.students.edit', compact('student', 'courses'));
    }

    // Update the student's information
    public function update(Request $request, Student $student)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'course_id' => 'required|exists:courses,id',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
            'profile_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate profile image
        ]);

        // Handle profile image update
        if ($request->hasFile('profile_image_url')) {
            // Delete the old image if it exists
            if ($student->profile_image_url && Storage::disk('public')->exists($student->profile_image_url)) {
                Storage::disk('public')->delete($student->profile_image_url);
            }
            // Store the new image
            $imagePath = $request->file('profile_image_url')->store('images/students', 'public');
            $student->profile_image_url = $imagePath;
        }

        // Update student information
        $student->update($request->all());

        // Redirect to the student list with a success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        // Delete the student's profile image if it exists
        if ($student->profile_image_url && Storage::disk('public')->exists($student->profile_image_url)) {
            Storage::disk('public')->delete($student->profile_image_url);
        }

        // Delete the student record
        $student->delete();

        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
