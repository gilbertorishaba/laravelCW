<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Display the enrollment index page
    public function index()
    {
        $enrollments = Enrollment::paginate(10);
        $statistics = $this->getStatistics(); // fetch statistics

        return view('backend.enrollments.index', compact('enrollments', 'statistics'));
    }

    // Form for creating a new enrollment
    public function create()
    {
        $courses = Course::all(); // Retrieve all courses
        return view('backend.enrollments.create', compact('courses'));
    }

    // Store a newly created enrollment in storage
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    // Show the form for editing the specified enrollment
    public function edit(Enrollment $enrollment)
    {
        return view('backend.enrollments.edit', compact('enrollment'));
    }

    // Update the specified enrollment in storage
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $enrollment->update($request->all());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    // Remove the specified enrollment from storage
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }

    // Method to fetch statistics (example)
    private function getStatistics()
    {
        return [
            [
                'title' => 'Total Enrollments',
                'value' => Enrollment::count(),
                'icon' => 'fas fa-users',
                'badgeType' => 'primary',
                'change' => '0',
            ],
            // Add other statistics as needed
        ];
    }
}
