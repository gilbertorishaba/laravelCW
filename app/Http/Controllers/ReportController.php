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
        // Validate the form inputs
        $validatedData = $request->validate([
            'report_type' => 'required|string|max:255',
            'dob' => 'required|date',
            'generated_by' => 'required|string|max:1000', // Ensuring 'generated_by' is required
        ]);

        // Store the report or perform any other action

        return redirect()->back()->with('success', 'Report generated successfully.');
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
