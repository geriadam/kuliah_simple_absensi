<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use App\Employee;
use App\EmployeeSalaryHour;
use App\EmployeeAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::query();
        $employees = $employees->with('user');

        if($request->has('search')){
            $search = $request->search;
            $employees = $employees->whereHas('user', function($query) use ($search){
                return $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('nip', 'like', '%'. $search .'%');
            });
        }

        $employees = $employees->orderBy('updated_at', 'desc');
        $employees = $employees->paginate(10, ['*']);

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        if(auth()->user()->id == 1){
            return view('employee.form');
        } else {
            return redirect()->route('employee.index')->with('status', 'Cant Access');
        }
    }

    public function store(Request $request)
    {
        DB::begintransaction();

        try {

            $request->request->add(['password' => Hash::make($request->password)]);
            $user = User::create($request->all());
            $user->markEmailAsVerified();

            $request->request->add(['user_id' => $user->id]);

            // Store to Employee
            $employee = Employee::create($request->all());

            $request->request->add(['employee_id' => $employee->id]);

            // Store to EmployeeSalaryHour
            EmployeeSalaryHour::create($request->all());

            DB::commit();

            return redirect()->route('employee.index');

        } catch (Exception $e) {
            DB::rollback();
            $request->session()->flash('danger', 'Failed Saved');

            return back()->withInput();
        }

        $employee = Employee::create($request->all());
        if ($employee) {            
            return redirect()->route('employee.index');
        }
    }

    public function edit(Employee $employee)
    {
        if(auth()->user()->can('onlyadmin', $employee)){
            return view('employee.form', compact('employee'));
        } else {
            return redirect()->route('employee.index')->with('status', 'Cant Access');
        }
    }

    public function update(Request $request, Employee $employee)
    {
        DB::begintransaction();

        try {

            // get user
            $user = $employee->user;

            // get all
            $input = $request->all();

            // check password
            if (! empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = array_except($input, ['password']);
            }

            // update user
            $user->update($input);

            // update employee
            $employee->update($request->all());

            // update salary hour
            $employee->salaryHour()->updateOrCreate(['employee_id' => $employee->id], $request->all());

            DB::commit();

            return redirect()->route('employee.index');

        } catch (Exception $e) {

            DB::rollback();
            $request->session()->flash('danger', 'Failed Saved');

            return back()->withInput();
        }
    }

    public function destroy(Employee $employee)
    {
        if(auth()->user()->can('delete', $employee)){
            if ($employee->delete()) {            
                return redirect()->route('employee.index');
            }
        } else {
            return redirect()->route('employee.index')->with('status', 'Cant Access');
        }
    }

    public function attendance(Employee $employee)
    {
        if(auth()->user()->can('attendance', $employee)){
            $employee_attendance = EmployeeAttendance::where('employee_id', $employee->id)
                ->whereDate('start_date', Carbon::today())
                ->first();

            if($employee_attendance){
                if(is_null($employee_attendance->end_date)){
                    $employee_attendance->update(['end_date' => Carbon::now()]);
                }

                return redirect()->route('employee.index')->with('status', 'Successfull Attendance Out');
            } else {
                EmployeeAttendance::create([
                    "employee_id" => $employee->id,
                    "start_date" => Carbon::now(),
                ]);

                return redirect()->route('employee.index')->with('status', 'Successfull Attendance In');
            }
        } else {
            return redirect()->route('employee.index')->with('status', 'Cant Access');
        }
    }

    public function mySalary(Employee $employee)
    {
        if(auth()->user()->can('mysalary', $employee)){
            $employees = EmployeeAttendance::where('employee_id', $employee->id)
                ->whereMonth('start_date', now()->month)
                ->paginate(10);

            return view('employee.mysalary', compact('employees'));
        } else {
            return redirect()->route('employee.index')->with('status', 'Cant Access');
        }  
    }
}
