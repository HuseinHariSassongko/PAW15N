<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Illuminate\View\View;
use App\Models\Position;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Employee List';
        // Ambil semua data employee beserta relasi position
        $employees = Employee::with('position')->get();

        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

public function create()
{
    $pageTitle = 'Create Employee';
    {
        $pageTitle = 'Create Employee';
        $positions = Position::all();

        return view('employee.create', compact('pageTitle', 'positions'));
    }
}

public function store(Request $request)
{
    {
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:employees',
            'age' => 'required|numeric|min:18',
            'position' => 'required',
            'cv' => 'required|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('public/files');
        }

        $employee = new Employee;
        $employee->firstname = $validated['firstName'];
        $employee->lastname = $validated['lastName'];
        $employee->email = $validated['email'];
        $employee->age = $validated['age'];
        $employee->position_id = $validated['position'];
        $employee->cv_path = $cvPath ?? null;
        $employee->save();

        return redirect()->route('employees.index')
            ->with('success', 'Employee has been added successfully.');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        return view('employee.edit', compact('pageTitle', 'positions', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = Employee::find($id);
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    // ELOQUENT
    Employee::find($id)->delete();

    return redirect()->route('employees.index');
    }
}
