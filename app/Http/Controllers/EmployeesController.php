<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Spatie\Permission\Models\Role;
use App\Models\Employee\EmployeeCode;

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

    public function store(Employee $employee, StoreEmployeeRequest $request) 
    {       
        $input = $request->all();          
        if(empty($input['employee_code'])){
            $employeeCode = new Employee();  
            $input['employee_code'] = $employeeCode->EmployeeCode();
        }
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

    public function update(Employee $employee, UpdateEmployeeRequest $request) 
    {        
        $user = User::find($employee->id);     
        // $user->syncRoles($request->designation);
        if(empty($employee->employee_code)){
            $employeeCode = new Employee();  
            $employee->employee_code = $employeeCode->EmployeeCode();
        }
        $employee->update($request->all());
        if ($user === null)
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = 'abcd123';
            $user->active = true;
            $employee->User()->save($user);
        }
        else
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => 'abcd123',
                'active' => true,
            ]);
        }
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
