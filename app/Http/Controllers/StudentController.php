<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import Session for flash messaging

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all(); // Retrieve all courses to pass to the view
        return view('backend.enrollments.create', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.students.create');
         // View for creating students
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'course_enrolled' => 'required|string|max:50',
            'dob' => 'required|date|min:5',
            'phone' => 'required|string|max:15'
        ]);

        // Create a new student instance and save
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course_enrolled = $request->input('course_enrolled');
        $student->dob = $request->input('dob');
        $student->phone = $request->input('phone');
        $student->save();

        // Flash message for success
        session()->flash('success', 'Student successfully added to the database');

        // Redirect to the student create page
        return redirect()->route('students.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('backend.students.show', compact('student')); // View for a single student
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('backend.students.edit', compact('student')); // View for editing a student
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'course_enrolled' => 'required|string|max:255',
            'dob' =>'required|date|max:50',
            'phone' => 'required|string|max:15'
        ]);

        // Update the student instance

        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course_enrolled');
        $student->dob = $request->input('dob');
        $student->phone = $request->input('phone');
        $student->save();

        // Flash message for success
        Session::flash('success', 'Student updated successfully');

        // Redirect to the student index page
        return redirect()->route('students.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        // Flash message for success
        Session::flash('success', 'Student deleted successfully');

        // Redirect back to the student index page
        return redirect()->route('students.create');
    }
}
