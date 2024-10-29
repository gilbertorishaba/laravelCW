@extends('backend.layouts.main')

@section('content')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #007bff;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px;
        }

        .btn-light {
            background-color: #f8f9fa;
            color: #007bff;
            border-radius: 20px;
        }

        .form-control {
            border: 1px solid #007bff;
            background-color: #e7f3ff;
            color: #333;
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            border-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .alert {
            border-radius: 5px;
        }
    </style>

    <div class="container">
        @include('backend.layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="page-header">
                            <h3 class="page-title">Add New Enrollment</h3>
                        </div>
                        <h4 class="card-title">Enrollment Registration Form</h4>
                        <p class="card-description">Fill out the details to enroll a student</p>

                        <form class="forms-sample" action="{{ route('enrollments.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="studentName">Student Name</label>
                                <input type="text" class="form-control" id="studentName" name="student_name"
                                    placeholder="Enter Student Name" required>
                            </div>

                            <div class="form-group">
                                <label for="courseName">Course Name</label>
                                <select class="form-control" id="courseName" name="course_name" required>
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="enrollmentDate">Enrollment Date</label>
                                <input type="date" class="form-control" id="enrollmentDate" name="enrollment_date"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('enrollments.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.layouts.footer')
    </div>
@endsection
