@extends('backend.layouts.main')

@section('content')
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .page-title {
            color: #2a4d85;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border: 1px solid #0056b3;
            background-color: #f1f9ff;
            color: #333;
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 85, 204, 0.3);
            border-color: #004080;
        }

        .btn-primary {
            background-color: #004080;
            border-color: #004080;
            font-weight: bold;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-light {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .alert {
            border-radius: 8px;
            background-color: #f9f9f9;
            padding: 20px;
            font-size: 1rem;
        }

        .alert-danger {
            color: #b00020;
        }
    </style>

    <div class="container">
        @include('backend.layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="page-title">Add New Enrollment</h2>

                        {{-- Enrollment Form --}}
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

                            {{-- Student Name --}}
                            <div class="form-group">
                                <label for="studentName">Student Name</label>
                                <input type="text" class="form-control" id="studentName" name="student_name"
                                    placeholder="Enter Student Name" required>
                            </div>

                            {{-- Course Name --}}
                            <div class="form-group">
                                <label for="studentInputcourse">Course Enrolled</label>
                                <select class="form-control" name="course_enrolled" id="studentInputcourse" required>
                                    <option value="">Select a Course</option>
                                    <option value="bbc">Business Computing</option>
                                    <option value="boim">Bachelor of Office Management</option>
                                    <option value="computer_science">Computer Science</option>
                                    <option value="software_engineering">Software Engineering</option>
                                    <option value="bist">Bachelor of Information Systems and Technology
                                    </option>
                                    <option value="law">Bachelor of Laws</option>
                                    <option value="bcom">Bachelor of Commerce</option>
                                    <option value="blis">Bachelor of Library and Information Sciences
                                    </option>
                                </select>
                            </div>

                            {{-- Enrollment Date --}}
                            <div class="form-group">
                                <label for="enrollmentDate">Enrollment Date</label>
                                <input type="date" class="form-control" id="enrollmentDate" name="enrollment_date"
                                    required>
                            </div>

                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            {{-- Submit & Cancel Buttons --}}
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
