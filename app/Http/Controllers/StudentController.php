<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Use pagination to handle large datasets
        $students = Student::paginate(10);
        return view('backend.students.index', compact('students'));
    }

    public function create()
    {
        return view('backend.students.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:students',
            'course_enrolled' => 'required|string|max:50',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15'
        ]);

        // Save student
        Student::create($request->all());

        // Use with() for flash messages
        return redirect()->route('students.index')->with('success', 'Student successfully added.');
    }

    public function show(Student $student)
    {
        return view('backend.students.show', compact('student'));
    }

    public function edit(Student $student)
    {

        return view('backend.students.edit', compact('student'));
    }


    public function update(Request $request, Student $student)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'course_enrolled' => 'nullable|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
        ]);

        // Update student
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
