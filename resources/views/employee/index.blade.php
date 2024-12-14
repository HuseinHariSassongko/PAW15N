@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Employee List</h3>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    Create Employee
                </a>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Position</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($employees->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No employees found.</td>
                                    </tr>
                                @else
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->firstname }}</td>
                                            <td>{{ $employee->lastname }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->age }}</td>
                                            <td>{{ $employee->position->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('employees.show', $employee->id) }}"
                                                        class="btn btn-light btn-sm border">
                                                        <i class="bi bi-person-lines-fill"></i>
                                                    </a>
                                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                                        class="btn btn-light btn-sm border">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}"
                                                        method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-light btn-sm border">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
