<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function leave()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.pages.Leave.leaveForm', compact('leaveTypes'));
    }

    public function leaveList()
    {
        $leaves = Leave::with(['type'])->paginate(5);
        return view('admin.pages.Leave.leaveList', compact('leaves'));
    }

    public function myLeave()
    {
        $employeeId = auth()->user()->employee->id;

        $leaves = Leave::where('employee_id', $employeeId)
            ->with(['type'])
            ->paginate(5);

        return view('admin.pages.Leave.myLeave', compact('leaves'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'leave_type_id' => 'required|exists:leave_types,id',
            'description' => 'required',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        $today = Carbon::today();
        $fromDate = Carbon::parse($request->from_date);

        if ($fromDate->lessThanOrEqualTo($today)) {
            notify()->error('Leave start date should be a future date.');
            return redirect()->back();
        }

        $toDate = Carbon::parse($request->to_date);
        $totalDays = $toDate->diffInDays($fromDate) + 1;

        $leaveType = LeaveType::findOrFail($request->leave_type_id);
        $leaveTypeTotalDays = $leaveType->leave_days;

        $userId = auth()->user()->id;
        $totalTakenDaysForLeaveType = Leave::where('employee_id', $userId)
            ->where('leave_type_id', $request->leave_type_id)
            ->where('status', 'approved')
            ->sum('total_days');

        if (($totalTakenDaysForLeaveType + $totalDays) > $leaveTypeTotalDays) {
            notify()->error('Exceeds available leave days for this type.');
            return redirect()->back();
        }

        $previousLeaveEndDate = Leave::where('employee_id', $userId)
            ->where('status', 'approved')
            ->orderBy('to_date', 'desc')
            ->value('to_date');

        if ($previousLeaveEndDate && Carbon::parse($previousLeaveEndDate)->isFuture()) {
            notify()->error('You cannot take leave until your previous leave date is over.');
            return redirect()->back();
        }

        Leave::create([
            'employee_id' => auth()->user()->employee->id,
            'department_id' => auth()->user()->employee->department_id,
            'designation_id' => auth()->user()->employee->designation_id,
            'leave_type_id' => $request->leave_type_id,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'total_days' => $totalDays,
            'description' => $request->description,
            'status' => 'pending', // Default status is pending
        ]);

        notify()->success('New Leave created');
        return redirect()->back();
    }

    // Approve and Reject Leave
    public function approveLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved';
        $leave->save();

        notify()->success('Leave approved');
        return redirect()->back();
    }

    public function rejectLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'rejected';
        $leave->save();

        notify()->error('Leave rejected');
        return redirect()->back();
    }

    // Leave Type Management
    public function leaveType()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.pages.leaveType.formList', compact('leaveTypes'));
    }

    public function leaveStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'leave_type_name' => 'required|string|max:50',
            'leave_days' => 'required|integer|min:0',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->errors()->first());
            return redirect()->back();
        }

        LeaveType::create([
            'leave_type_name' => $request->leave_type_name,
            'leave_days' => $request->leave_days,
        ]);

        notify()->success('New Leave Type created successfully.');
        return redirect()->back();
    }

    public function leaveDelete($id)
    {
        $leaveType = LeaveType::find($id);
        if ($leaveType) {
            $leaveType->delete();
            notify()->success('Deleted Successfully.');
        } else {
            notify()->error('Leave Type not found.');
        }
        return redirect()->back();
    }

    public function leaveEdit($id)
    {
        $leaveType = LeaveType::find($id);
        return view('admin.pages.leaveType.editList', compact('leaveType'));
    }

    public function leaveUpdate(Request $request, $id)
    {
        $leaveType = LeaveType::find($id);

        $validate = Validator::make($request->all(), [
            'leave_type_name' => 'required|string|max:50',
            'leave_days' => 'required|integer|min:0',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->errors()->first());
            return redirect()->back();
        }

        if ($leaveType) {
            $leaveType->update([
                'leave_type_name' => $request->leave_type_name,
                'leave_days' => $request->leave_days,
            ]);

            notify()->success('Your information updated successfully.');
        } else {
            notify()->error('Leave Type not found.');
        }

        return redirect()->route('leave.leaveType');
    }

    public function showLeaveBalance()
    {
        $userId = auth()->user()->id;
        $designation = auth()->user()->employee->designation->designation_name;

        $designationLeaveDays = [
            'Android Developer' => 20,
            'Web Developer' => 20,
            'Manager' => 25,
            'Software Developer' => 20,
            'IT Director' => 25,
            'System Administrator' => 25,
            'Content Creator' => 20,
            'Chief Financial Officer' => 25,
            'Sales Director' => 25,
            'Sales Support Specialist' => 20,
            'Customer Support' => 20,
        ];

        $leaveTypeBalances = [];
        $totalTakenDays = 0;

        $leaves = Leave::where('employee_id', $userId)
            ->whereYear('from_date', '=', date('Y'))
            ->with('type')
            ->get();

        foreach ($leaves as $leave) {
            $leaveType = $leave->type->leave_type_name;
            $leaveLimit = $leave->type->leave_days;

            if (!isset($leaveTypeBalances[$leaveType])) {
                $leaveTypeBalances[$leaveType] = [
                    'totalDays' => $leaveLimit,
                    'takenDays' => 0,
                    'availableDays' => $leaveLimit,
                ];
            }

            if ($leave->status === 'approved') {
                $leaveTypeBalances[$leaveType]['takenDays'] += $leave->total_days;
                $leaveTypeBalances[$leaveType]['availableDays'] -= $leave->total_days;

                $totalTakenDays += $leave->total_days;
            }
        }

        $availableDays = $designationLeaveDays[$designation] - $totalTakenDays;
        $leaveTypeBalances[$designation] = [
            'totalDays' => $designationLeaveDays[$designation],
            'takenDays' => $totalTakenDays,
            'availableDays' => $availableDays,
        ];

        return view('admin.pages.Leave.myLeaveBalance', compact('leaveTypeBalances', 'totalTakenDays', 'designationLeaveDays', 'designation', 'availableDays'));
    }

    public function allLeaveReport()
    {
        $leaves = Leave::where('status', 'approved')
            ->with(['type'])
            ->paginate(5);

        return view('admin.pages.Leave.allLeaveReport', compact('leaves'));
    }
}
