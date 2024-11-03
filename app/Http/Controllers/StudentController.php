<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'course_enrolled' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
            'profile_image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the image
        ]);

        // Handle file upload
        if ($request->hasFile('profile_image_url')) {
            // Store the uploaded image
            $file = $request->file('profile_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/students', $fileName, 'public');
            $validatedData['profile_image_url'] = '/storage/' . $filePath; // Save path to database
        }

        // Insert the data into the database
        Student::create($validatedData);

        // Redirect or return response
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
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
            'profile_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image validation
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image_url')) {
            // Delete the old image if it exists
            if ($student->profile_image_url && Storage::disk('public')->exists($student->profile_image_url)) {
                Storage::disk('public')->delete($student->profile_image_url);
            }

            // Upload the new image and update the path
            $imagePath = $request->file('profile_image_url')->store('images/students', 'public');
            // $student->'profile_image_url' = $imagePath;
            $student->profile_image_url = $imagePath;

        }

        // Update student
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        // Delete the image if it exists
        if ($student->profile_image_url && Storage::disk('public')->exists($student->profile_image_url)) {
            Storage::disk('public')->delete($student->profile_image_url);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
