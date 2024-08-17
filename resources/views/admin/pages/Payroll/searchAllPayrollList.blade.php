@extends('admin.master')

@section('content')
<div class="shadow p-4 d-flex justify-content-between align-items-center ">
    <h4 class="text-uppercase">Payroll List</h4>
    <div>
        <a href="{{ route('payroll.create') }}" class="btn btn-success p-2 text-lg rounded-pill">Create New Payroll</a>
    </div>
</div>
<div class=" my-5 py-5">
    <div class="fw-normal mb-4">
        <h2 class="fw-normal fs-5 mx-auto text-center rounded-pill p-2 w-50 mb-5
            @if ($foundCount > 0) bg-success
            @else
                bg-danger text-white @endif">
            @if ($foundCount === 1)
            Found 1 matching data for "{{ request()->search }}"
            @elseif ($foundCount > 1)
            Found {{ $foundCount }} matching data for "{{ request()->search }}"
            @else
            No Data found for "{{ request()->search }}"
            @endif
        </h2>
    </div>


    @if ($foundCount !== null && $foundCount > 0)
    <table class="table align-middle mb-4 text-center bg-white">
        <thead class="bg-light">
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Dept</th>
                <th>desig</th>
                <th>Month</th>
                <th>Year</th>
                <th>Salary Type</th>
                <th>Salary</th>
                <th>Deduction</th>
                <th>Reason</th>
                <th>Net Pay</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr>
                <td>{{ $payroll->employee->name }}</td>
                <td>{{ $payroll->date }}</td>
                <td>{{ $payroll->employee->department->department_name }}</td>
                <td>{{ $payroll->employee->designation->designation_name }}</td>
                <td>{{ $payroll->month }}</td>
                <td>{{ $payroll->year }}</td>
                <td>{{ $payroll->salaryStructure->salary_class }}</td>
                <td>{{ $payroll->salaryStructure->total_salary }}</td>
                <td>{{ $payroll->deduction }}</td>
                <td>{{ $payroll->reason }}</td>
                <td>{{ $payroll->total_payable }}</td>
                <td>
                    <a class="btn btn-success rounded-pill"
                        href="{{ route('singlePayroll', ['employee_id' => $payroll->employee_id, 'month' => $payroll->month]) }}">
                        Payslip
                    </a>

                    <a class="btn btn-warning rounded-pill" href="{{ route('payrollEdit', $payroll->id) }}">Edit</a>
                    <a class="btn btn-danger rounded-pill" href="{{ route('payrollDelete', $payroll->id) }}">Delete</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @elseif ($foundCount === 0)
    <p>No Data found for "{{ request()->search }}"</p>
    @else
    <p>Please enter a search term to find data</p> --}}
    @endif
    <div class="w-25 mx-auto">
        {{-- {{ $salaries->links() }} --}}
    </div>
</div>
@endsection