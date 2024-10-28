<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Profile Section -->
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="images/faces/face5.jpg" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">Welcome </p>
                    <p class="designation">Super Admin</p>
                </div>
            </div>
        </li>

        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Student Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#student-menu" aria-expanded="false"
                aria-controls="student-menu">
                <i class="fab fa-trello menu-icon"></i>
                <span class="menu-title">Student</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="student-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('students.create') }}">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Students</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Course Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#course-menu" aria-expanded="false"
                aria-controls="course-menu">
                <i class="fab fa-trello menu-icon"></i>
                <span class="menu-title">Course</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="course-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.create') }}">Add Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Course</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
