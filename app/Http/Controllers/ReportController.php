<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Report;
use Illuminate\Http\Request;
use Auth; // Assuming you're using Laravel's built-in authentication

class ReportController extends Controller
{
    // Display a listing of the reports
    public function index()
    {
        $reports = Report::all(); // Get all reports
        return view(' backend.reports.index', compact('reports')); // Create a view to display reports
    }

    // Show the form for creating a new report
    public function create()
    {
        $courses = Course::all(); // Fetch all courses to pass to the view

        return view('backend.reports.create', compact('courses')); // Pass the courses variable to the view
    }



    // Display the specified report
    public function store(Request $request)
    {
        $request->validate([
            'report_type' => 'required',
            'report_title' => 'required',
            'course_id' => 'required|integer',  // Validate that course_id is present and is an integer
            'generated_by' => 'required',
        ]);

        // Create the new report
        Report::create([
            'report_type' => $request->input('report_type'),
            'report_title' => $request->input('report_title'),
            'course_id' => $request->input('course_id'),  // Save the course_id
            'generated_by' => $request->input('generated_by'),
        ]);

        return redirect()->route(' backend.reports.index')->with('success', 'Report created successfully!');
    }


    // Show the form for editing the specified report
    public function edit($id)
    {
        $report = Report::findOrFail($id); // Find the report by ID
        return view('reports.edit', compact('report')); // Create a view for the report edit form
    }

    // Update the specified report in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'report_type' => 'required|string|max:255',
        ]);

        $report = Report::findOrFail($id); // Find the report by ID
        $report->update([
            'report_type' => $request->input('report_type'),
        ]);

        return redirect()->route(' backend.reports.index')->with('success', 'Report updated successfully.');
    }

    // Remove the specified report from storage
    public function destroy($id)
    {
        $report = Report::findOrFail($id); // Find the report by ID
        $report->delete(); // Delete the report

        return redirect()->route('backend.reports.index')->with('success', 'Report deleted successfully.');
    }
}
