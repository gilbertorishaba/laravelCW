@extends('backend.layouts.main')

@section('content')
    <div class="container-scroller">
        <!-- Navbar -->
        @include('backend.layouts.nav')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('backend.layouts.sidebar')

            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1>Enrolled Students</h1>
                    <h2>Students Enrolled in Courses</h2>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->students as $student)
                                <tr>
                                    <td>{{ $course->name }}</td> <!-- Course name -->
                                    <td>{{ $student->name }}</td> <!-- Student's name -->
                                    <td>{{ $student->email }}</td> <!-- Student's email -->
                                    <td>{{ $student->phone }}</td> <!-- Student's phone -->
                                    <td>{{ \Carbon\Carbon::parse($student->pivot->enrollment_date)->format('d-m-Y') }}
                                    </td> <!-- Enrollment date -->
                                    <td>{{ ucfirst($student->pivot->status) }}</td>
                                    <!-- Enrollment status -->
                                    <td>{{ $student->pivot->grade ?? 'N/A' }}</td> <!-- Student's grade -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <!-- Footer -->
                @include('backend.layouts.footer')
            </div>
        </div>
    </div>
@endsection
