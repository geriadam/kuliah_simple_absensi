<?php

namespace App\Http\Controllers;

use View;
use App\Employee;
use App\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function __construct()
    {
        View::share([
            'employees_dropdown' => Employee::dropdownData(),
        ]);
    }

    public function index(Request $request)
    {
        $employees = EmployeeAttendance::query();

        if($request->has('employee_id')){
            $employee_id = $request->employee_id;
            $employees = $employees->where('employee_id', $employee_id);
        }

        $employees = $employees->orderBy('updated_at', 'desc');
        $employees = $employees->paginate(10, ['*']);

        return view('employee_attendance.index', compact('employees'));
    }
}
