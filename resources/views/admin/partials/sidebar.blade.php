<div class="sidebar" id="sidebar">

    {{-- Dashboard --}}
    <ul class="list-unstyled mb-5">
        <li class="sidebar-list-item"><a class="sidebar-link text-muted active" href="{{ route('dashboard') }}">
                <span class="sidebar-link-title fs-5">Dashboards</span></a>
        </li>

        @employee
        {{-- User Profile --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('profile') }}">
                <i class="fa-regular fa-user me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Profile</span></a>
        </li>
        @endemployee

        @admin
        {{-- Organization --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('organization.department') }}">
                <i class="fa-solid fa-building me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Organization - Department</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('organization.designationList') }}">
                <i class="fa-solid fa-building me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Organization - Designation</span></a>
        </li>

        {{-- Salary Structure --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('salary.create.form') }}">
                <i class="fa-solid fa-dollar-sign me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">PayGrade</span></a>
        </li>

        {{-- Employees --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('manageEmployee.addEmployee') }}">
                <i class="fa-solid fa-user-group me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Add Employee</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('manageEmployee.ViewEmployee') }}">
                <i class="fa-solid fa-user-group me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">View Employee</span></a>
        </li>
        @endadmin

        {{-- Attendance --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('attendance.viewAttendance') }}">
                <i class="fa-regular fa-clock me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Attendance - View</span></a>
        </li>
        @employee
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('attendance.giveAttendance') }}">
                <i class="fa-regular fa-clock me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Give Attendance</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('attendance.myAttendance') }}">
                <i class="fa-regular fa-clock me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">My Attendance</span></a>
        </li>
        @endemployee

        {{-- Leave --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('leave.leaveForm') }}">
                <i class="fa-solid fa-person-walking-arrow-right me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Apply Leave</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('leave.myLeave') }}">
                <i class="fa-solid fa-person-walking-arrow-right me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">My Leave</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('leave.myLeaveBalance') }}">
                <i class="fa-solid fa-person-walking-arrow-right me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">My Leave Balance</span></a>
        </li>
        @admin
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('leave.leaveStatus') }}">
                <i class="fa-solid fa-person-walking-arrow-right me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Leave Request</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('leave.leaveType') }}">
                <i class="fa-solid fa-person-walking-arrow-right me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Leave Type</span></a>
        </li>
        @endadmin

        {{-- Task Management --}}
        @admin
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('createTask') }}">
                <i class="fa-solid fa-list-check me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Assign Task</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('taskList') }}">
                <i class="fa-solid fa-list-check me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Task List</span></a>
        </li>
        @endadmin
        @employee
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('myTask') }}">
                <i class="fa-solid fa-list-check me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">My Task</span></a>
        </li>
        @endemployee

        {{-- Payroll --}}
        @admin
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('payroll.create') }}">
                <i class="fa-solid fa-file-invoice-dollar me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Create Payroll</span></a>
        </li>
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('payroll.view') }}">
                <i class="fa-solid fa-file-invoice-dollar me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Payroll List</span></a>
        </li>
        @endadmin
        @employee
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('myPayroll') }}">
                <i class="fa-solid fa-file-invoice-dollar me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">My Payroll</span></a>
        </li>
        @endemployee

        {{-- Users --}}
        @admin
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('users.list') }}">
                <i class="fa-solid fa-circle-user me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Users</span></a>
        </li>
        @endadmin

        {{-- Notice --}}
        <li class="sidebar-list-item py-2"><a class="sidebar-link text-muted" href="{{ route('show.notice') }}">
                <i class="fa-solid fa-check me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Notices</span></a>
        </li>
    </ul>

    @admin
    <hr>

    <div class="mt-5">
        <li class="list-unstyled"><a class="sidebar-link text-muted" href="{{ route('service.form') }}">
                <i class="fa-brands fa-servicestack me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Services</span></a>
        </li>
        <li class="list-unstyled"><a class="sidebar-link text-muted" href="{{ route('notice.create') }}">
                <i class="fa-brands fa-hubspot me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Notices Hub</span></a>
        </li>
        <li class="list-unstyled"><a class="sidebar-link text-muted" href="{{ route('client.form') }}">
                <i class="fa-regular fa-handshake me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Clients</span></a>
        </li>
        <li class="list-unstyled"><a class="sidebar-link text-muted" href="{{ route('message') }}">
                <i class="fa-regular fa-message me-2 text-info"></i>
                <span class="sidebar-link-title fs-5">Messages</span></a>
        </li>
    </div>
    @endadmin

</div>
