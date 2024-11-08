<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Report;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('backend.reports.index', compact('reports'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('backend.reports.create', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'report_type' => 'required|string|max:255',
            'generated_at' => 'required|date',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Automatically set generated_by to the authenticated admin
        $validatedData['generated_by'] = Auth::user()->name;

        // Store the validated data in the database
        Report::create([
            'report_type' => $validatedData['report_type'],
            'generated_at' => $validatedData['generated_at'],
            'generated_by' => $validatedData['generated_by'],
            'course_id' => $validatedData['course_id'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Report generated successfully.');
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'report_type' => 'required|string|max:255',
        ]);

        $report = Report::findOrFail($id);
        $report->update([
            'report_type' => $request->input('report_type'),
        ]);

        return redirect()->route('backend.reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('backend.reports.index')->with('success', 'Report deleted successfully.');
    }
}
