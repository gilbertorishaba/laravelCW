@extends('backend.layouts.main')

@section('content')
    <div class="container-scroller">
        @include('backend.layouts.nav') <!-- Responsive navbar -->

        <div class="container-fluid page-body-wrapper">
            @include('backend.layouts.sidebar') <!-- Advanced sidebar with icons -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Chaapa Student Management System</h3>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row grid-margin">
                        <div class="col-12">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                        @foreach ($statistics as $stat)
                                            <div class="statistics-item">
                                                <p><i class="icon-sm {{ $stat['icon'] }} mr-2"></i>{{ $stat['title'] }}</p>
                                                <h2>{{ $stat['value'] }}</h2>
                                                <label
                                                    class="badge badge-outline-{{ $stat['badgeType'] }} badge-pill">{{ $stat['change'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fas fa-gift"></i> Registration
                                    </h4>
                                    <canvas id="orders-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fas fa-chart-line"></i> Registered Students
                                    </h4>
                                    <h2 class="mb-5">200 <span class="text-muted h4 font-weight-normal">Students</span>
                                    </h2>
                                    <canvas id="sales-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Table -->
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enrollment List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student Name</th>
                                                    <th>Course</th>
                                                    <th>Enrollment Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enrollments as $enrollment)
                                                    <tr>
                                                        <td>{{ $enrollment->id }}</td>
                                                        <td>{{ $enrollment->student_name }}</td>
                                                        <td>{{ $enrollment->course_name }}</td>
                                                        <td>{{ $enrollment->enrollment_date->format('Y-m-d') }}</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $enrollment->status == 'active' ? 'success' : 'danger' }}">
                                                                {{ ucfirst($enrollment->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                                                class="btn btn-warning btn-sm">Edit</a>
                                                            <form
                                                                action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @include('backend.layouts.footer') <!-- Modern footer with social icons -->
            </div>
        </div>
    </div>
@endsection
