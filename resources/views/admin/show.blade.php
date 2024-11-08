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
                    <h2>Students Enrolled in {{ $course->name }}</h2>

                    <!-- Table displaying enrolled students -->
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($student->enrollment_date)->format('d-m-Y') }}</td>
                                    <!-- Enrollment Date -->
                                    <td>{{ ucfirst($student->status) }}</td>
                                    <!-- Status (assumed to be a column in the students table) -->
                                    <td>{{ $student->grade ?? 'N/A' }}</td>
                                    <!-- Grade (nullable, so show 'N/A' if not available) -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($student->pivot->enrollment_date)->format('d-m-Y') }}</td>
                                    <!-- Enrollment Date from the pivot table -->
                                    <td>{{ ucfirst($student->pivot->status) }}</td>
                                    <!-- Status from the pivot table -->
                                    <td>{{ $student->pivot->grade ?? 'N/A' }}</td>
                                    <!-- Grade from the pivot table, show 'N/A' if not available -->
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
