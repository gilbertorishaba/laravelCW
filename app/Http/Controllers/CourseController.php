<?php

// app/Http/Controllers/CourseController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Show form for creating a new course
    public function create()
    {
        return view('backend.courses.create');
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credit_hours' => 'required|integer',
        ]);

        Course::create([
            'course_name' => $request->course_name,
            'description' => $request->description,
            'credit_hours' => $request->credit_hours,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    // Display all courses (list)
    public function index()
    {
        // Use paginate() instead of all() to enable pagination
        $courses = Course::paginate(10); // 10 courses per page
        return view('backend.courses.index', compact('courses'));
    }

    // Edit an existing course
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('backend.courses.edit', compact('course'));
    }

    // Update an existing course
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credit_hours' => 'required|integer',
        ]);

        $course->update([
            'course_name' => $request->course_name,
            'description' => $request->description,
            'credit_hours' => $request->credit_hours,
        ]);

        return redirect()->route('backend.courses.index')->with('success', 'Course updated successfully.');
    }

    // Delete an existing course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('backend.courses.index')->with('success', 'Course deleted successfully.');
    }
}
