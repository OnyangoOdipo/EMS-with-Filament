<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SalaryStructure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.pages.AdminLogin.adminLogin');
    }

    public function loginPost(Request $request)
    {
        $val = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:12',
            ]
        );

        if ($val->fails()) {
            //message
            return redirect()->back()->withErrors($val);
        }

        $credentials = $request->except('_token');

        $login = auth()->attempt($credentials);
        if ($login) {
            notify()->success('Successfully Logged in');
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors('invalid user email or password');
    }

    public function register()
    {
        return view('admin.pages.AdminLogin.adminRegister');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        notify()->success('Registration successful. You can now log in.');
        return redirect()->route('admin.login');
    }

    public function logout()
    {

        auth()->logout();
        notify()->success('Successfully Logged Out');
        return redirect()->route('admin.login');
    }


    public function list()
    {
        $users = User::all();
        $employee = Employee::first(); // Fetches the first employee
        return view('admin.pages.Users.list', compact('users', 'employee'));
    }


    public function createForm($employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return redirect()->back()->withErrors('Employee not found');
        }

        return view('admin.pages.Users.createForm', compact('employee'));
    }


    public function userProfile($id)
    {
        $user = User::with('employee')->find($id);
        $employee = $user->employee ?? null;
        $departments = Department::all();
        $designations = Designation::all();
        $salaries = SalaryStructure::all();
        return view('admin.pages.Users.userProfile', compact('user', 'employee', 'departments', 'designations', 'salaries'));
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            notify()->error('Invalid Credentials.');
            return redirect()->back();
        }

        $fileName = null;
        if ($request->hasFile('user_image')) {
            $file = $request->file('user_image');
            $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();

            $file->storeAs('/uploads', $fileName);
        }

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'image' => $fileName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Find associated employee using the email and assign user_id to employee
        $employee = Employee::where('email', $request->email)->first();
        if ($employee) {
            $employee->user_id = $user->id;
            $employee->save();
        }

        notify()->success('User created successfully.');
        return redirect()->route('users.list');
    }

    // single  profile

    public function myProfile()
    {
        $user = Auth::user();
        if ($user->employee) {
            $employee = $user->employee;
            $departments = Department::all();
            $designations = Designation::all();
            $salaries = SalaryStructure::all();
            return view('admin.pages.Users.employeeProfile', compact('user', 'employee', 'departments', 'designations', 'salaries'));
        } else {
            return view('admin.pages.Users.nonEmployeeProfile', compact('user'));
        }
    }

    // user delete

    public function userDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }

        notify()->success('User Deleted Successfully.');
        return redirect()->back();
    }

    // User edit, update

    public function userEdit($id)
    {
        $user = User::find($id);
        $employee = Employee::find($id);
        return view('admin.pages.Users.editUser', compact('user', 'employee'));
    }


    public function userUpdate(Request $request, $id)
    {


        $user = User::find($id);

        if ($user) {

            $fileName = $user->image;
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();

                $file->storeAs('/uploads', $fileName);
            }

            $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'image' => $fileName,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ]);
            // Find associated employee using the email and assign user_id to employee
            $employee = Employee::where('email', $request->email)->first();
            if ($employee) {
                $employee->user_id = $user->id;
                $employee->save();
            }

            notify()->success('User updated successfully.');
            return redirect()->route('users.list');
        }
    }

    // Search User
    public function searchUser(Request $request)
    {
        $searchTerm = $request->search;
        if ($searchTerm) {
            $users = User::where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('role', 'LIKE', '%' . $searchTerm . '%')
                ->get();
        } else {
            $users = User::all();
        }

        return view('admin.pages.Users.searchUserList', compact('users'));
    }
}
