<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;



class EmployeeController extends Controller
{
    public function index ()
    {
        $employees = Employee::get();
        $company_name=Company::all();
        return view('Dashboard.employee.index' , compact('employees','company_name'));
    }// end of index method

    public function create ()
    {
        $company_name=Company::all();
        return view('Dashboard.employee.create', compact('company_name'));

    }// end of create method

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,$id',
            'phone' => 'required|numeric|digits:11',
            'company_id'=>'required',
        ]);


        Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            //get the id of company to save it and know his company
            'company_id' => $request->company_id,
        ]);
        return redirect( route('employees.index') );
    }// end of store method

    public function edit (Employee $employee)
    {
        $company_name=Company::all();
        return view('Dashboard.employee.edit' , compact('employee','company_name') );
    }// end of edit method

    public function update(Request $request , $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'company_id'=>'required',
        ]);

        $employee = Employee::findOrFail($id);

        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
        ]);
        return redirect( route('employees.index'));
    }
    public function delete(Employee $employee)
    {
        $employee->delete();
        return redirect( route('employees.index'));
    }
}
