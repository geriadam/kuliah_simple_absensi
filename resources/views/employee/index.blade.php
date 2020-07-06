@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(auth()->user()->id == 1)
                        <div class="">
                            <a class="btn btn-sm btn-primary" href="{{ route('employee.create') }}">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    @endif
                    <br>
                    <form action="">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name or NIP" value="{{ request()->search }}">
                    </form>
                </div>
            </div>
            @if($employees->count() != 0)
                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>NIP</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->user->nip }}</td>
                                        <td>{{ $employee->user->name }}</td>
                                        <td>{{ $employee->sex_text }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>
                                            @can('attendance', $employee)
                                                <a class="btn btn-sm btn-info" href="{{ route('employee.attendance', $employee) }}">
                                                    Attendance
                                                </a>
                                            @endcan
                                            @can('mysalary', $employee)
                                                <a class="btn btn-sm btn-primary" href="{{ route('employee.mysalary', $employee) }}">
                                                    My Salary this Month
                                                </a>
                                            @endcan
                                            @can('update', $employee)
                                                <a class="btn btn-sm btn-warning" href="{{ route('employee.edit', $employee) }}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('delete', $employee)
                                                <a class="btn btn-sm btn-danger" href="{{ route('employee.destroy', $employee) }}">
                                                    Delete
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {!! $employees->links() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
