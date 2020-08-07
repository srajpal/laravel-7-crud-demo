<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * EmployeeController constructor.
     * restrict controller using auth middleware
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        // uses the CompanyPolicy view to check if authorized
        $this->authorize('view',$company);

        return view('employees.index')->with([
            'company' => $company,
            'employees' => $company->employees()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        // uses the CompanyPolicy view to check if authorized
        $this->authorize('view',$company);

        return view('employees.create')->with([
            'company' => $company
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        // uses the CompanyPolicy view to check if authorized
        $this->authorize('view',$company);

        // validate the input from the request
        $inputs = $request->validate([
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
        ]);

        // create the employee and use ORM to attach to company
        $company->employees()->create($inputs);

        // use flash to return a message
        session()->flash('message-success','Employee, '.$inputs['first_name'].' '.$inputs['last_name'].', created');

        return redirect(route('employees.index', $company->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, Employee $employee)
    {
        // uses the EmployeePolicy view to check if authorized
        $this->authorize('view',[$company, $employee]);

        return view('employees.edit')->with([
            'company' => $company,
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Employee $employee)
    {
        // uses the EmployeePolicy view to check if authorized
        $this->authorize('view',[$company, $employee]);

        return view('employees.edit')->with([
            'company' => $company,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, Employee $employee)
    {
        // uses the EmployeePolicy update to check if authorized
        $this->authorize('update',[$company, $employee]);

        // validate the input from the request
        $inputs = $request->validate([
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
        ]);

        // create the employee and use ORM to attach to company
        $employee->update($inputs);

        // use flash to return a message
        session()->flash('message-success','Employee, '.$inputs['first_name'].' '.$inputs['last_name'].', updated');

        return redirect(route('employees.index', $company->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company, Employee $employee)
    {
        // uses the EmployeePolicy delete to check if authorized
        $this->authorize('delete',[$company, $employee]);

        $name = $employee->first_name.' '.$employee->last_name;
        $employee->delete();

        // use flash to return a message
        session()->flash('message-success','Employee, '.$name.', was deleted');

        // if we made the employees.destroy call using jQuery.ajax or other ajax method
        // return the status as a JSON string
        if ($request->ajax()) {
            return ['status'=>true];
        }

        return redirect(route('employees.index'));
    }
}
