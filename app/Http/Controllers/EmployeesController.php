<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\EmployeeRequest;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', ['employees' => $employees]);
    }

    public function create()
    {
        $employees = Employee::select('id','name','designation')->get();
        return view('employees.create', ['employees' => $employees]);
    }

    public function store(Employee $employee, EmployeeRequest $request) 
    {
        $input = $request->all();    

        $input['name'] = $request->name;
        $input['password'] = 'abcd123';
        $input['active'] = true;
        
        $user = User::create($input);
        $employee = $user->Employee()->create($input);
        $request->session()->flash('success', 'Employee saved successfully!');
        return redirect()->route('employees.index'); 
    }
  
    public function show(Employee $employee)
    {        
        $abm = Employee::select('id','name')
                        ->where('reporting_office_1',$employee->id)
                        ->where('designation','ABM')
                        ->get();
        return $abm;
    }
    
    public function getReportingOfficer3(Employee $employee)
    {
        $mehq = Employee::select('id','name')
                        ->where('reporting_office_2',$employee->id)
                        ->where('designation','MEHQ')
                        ->get();
        return $mehq;
    }

    public function edit(Employee $employee)
    {
        $employee_list = Employee::select('id','name','designation')->get();
        return view('employees.edit', ['employee' => $employee, 'employee_list' => $employee_list]);
    }

    public function update(Employee $employee, EmployeeRequest $request) 
    {
        $input = $request->all();
        $user = User::find($employee->id);
        $employee->update($request->all());

      
        $request->session()->flash('success', 'Employee updated successfully!');
        return redirect()->route('employees.index');
    }
  
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();
        $request->session()->flash('success', 'Employee deleted successfully!');
        return redirect()->route('employees.index');
    }
}
