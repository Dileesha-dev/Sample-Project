<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepo;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index', ['employees' => Employee::orderByDesc('created_at')->paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create', ['companies' => Company::all(['id', 'name'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->employeeRepo->validateInput($request);
        $logoImageData = ($request->hasFile('profile_photo') ? $this->employeeRepo->uploadImage($request) : null);
        $data = $request->except('profile_photo', '_token');
        if($logoImageData) $data += ['profile_photo_url' => $logoImageData['profile_photo_url'], 'profile_photo_path' => $logoImageData['profile_photo_path'], 'profile_photo_disk' => $logoImageData['profile_photo_disk']];
        $employee = Employee::create($data);
        return back()->with('success', 'Employee Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        return view('employee.create', ['employee' => $employee, 'companies' => Company::all(['id', 'name'])]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $logoImageData = ($request->hasFile('profile_photo') ? $this->employeeRepo->uploadImage($request) : null);
        $data = $request->except('profile_photo', '_token');
        if($logoImageData) $data += ['profile_photo_url' => $logoImageData['profile_photo_url'], 'profile_photo_path' => $logoImageData['profile_photo_path'], 'profile_photo_disk' => $logoImageData['profile_photo_disk']];
        $employee->update($data);
        return back()->with('success', 'Employee Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $employee->delete();
        return redirect(route('employee.index'))->with('success', 'Employee Successfully Deleted!');
    }
}
