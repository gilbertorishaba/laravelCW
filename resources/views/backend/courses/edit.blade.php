{{-- @extends('backend.layouts.app')

@section('content')
    <h1>Edit Course</h1>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" value="{{ $course->course_name }}" required>

        <label for="description">Description:</label>
        <textarea name="description">{{ $course->description }}</textarea>

        <label for="credit_hours">Credit Hours:</label>
        <input type="number" name="credit_hours" value="{{ $course->credit_hours }}">

        <button type="submit">Update Course</button>
    </form>
@endsection --}}
