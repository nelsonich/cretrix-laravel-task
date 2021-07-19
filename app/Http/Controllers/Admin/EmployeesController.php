<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function employees()
    {
        $employees = Employee::with('company')->paginate(10);
        $companies = Company::all();

        return view('pages.employees', [
            'employees' => $employees,
            'companies' => $companies,
        ]);
    }

    public function single_employee($id)
    {
        $employee = Employee::find($id);
        $companies = Company::all();

        return view('pages.single_employee', [
            'employee' => $employee,
            'companies' => $companies,
        ]);
    }

    public function create_employee(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'email',
        ]);

        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $company_id = $request->post('company_id');

        $employee = new Employee();
        $employee->firstname = $firstname;
        $employee->lastname = $lastname;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->company_id = $company_id;
        $employee->save();

        return redirect()->back();
    }

    public function update_employee(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'email',
        ]);
        
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $company_id = $request->post('company_id');

        $employee = Employee::find($id);
        $employee->firstname = $firstname;
        $employee->lastname = $lastname;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->company_id = $company_id;
        $employee->save();

        return redirect()->back();
    }

    public function remove_employee($id)
    {
        Employee::destroy($id);

        return redirect('/dashboard/employees');
    }
}
