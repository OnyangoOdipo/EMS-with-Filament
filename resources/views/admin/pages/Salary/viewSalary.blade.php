@extends('admin.master')

@section('content')
<div class="shadow p-4 d-flex justify-content-between align-items-center">
    <h4 class="text-uppercase">View Salary List</h4>
    <div>
        <a href="{{ route('salary.create.form') }}" class="btn btn-success p-2 text-lg rounded-pill"><i
                class="fa-solid fa-plus  me-1"></i>Create New
            Salary</a>
    </div>
</div>
<div class="container my-5 py-5">
    <table class="table align-middle mb-4 text-center bg-white">
        <thead class="bg-light">
            <tr>
                <th>SL NO</th>
                <th>Salary Class</th>
                <th>Basic Salary</th>
                <th>Medical Expenses</th>
                <th>Mobile Allowance</th>
                <th>House Rent Allowance</th> <!-- Added new header for House Rent Allowance -->
                <th>Total Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $key => $salary)
            @php
            // Include house rent allowance in total salary calculation
            $totalSalary = $salary->basic_salary + $salary->medical_expenses +
            $salary->mobile_allowance + $salary->houseRent_allowance;
            $salary->total_salary = $totalSalary;
            $salary->save();
            @endphp
            <tr>
                <td>
                    <div>
                        <p class="fw-bold mb-1">{{ $key + 1 }}</p>
                    </div>
                </td>
                <td>{{ $salary->salary_class }}</td>
                <td>{{ $salary->basic_salary }} BDT</td>
                <td>{{ $salary->medical_expenses }} BDT</td>
                <td>{{ $salary->mobile_allowance }} BDT</td>
                <td>{{ $salary->houseRent_allowance }} BDT</td>
                <!-- Displaying House Rent Allowance -->
                <td>{{ $totalSalary }} BDT</td>
                <td>
                    <a class="btn btn-success rounded-pill" href="{{ route('salaryEdit', $salary->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger rounded-pill" href="{{ route('salaryDelete', $salary->id) }}"><i
                            class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-25 mx-auto">
        {{ $salaries->links() }}
    </div>
</div>
@endsection