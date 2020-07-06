@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee Attendance Today</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form action="">
                        {!! Form::select('employee_id', $employees_dropdown, request()->employee_id ?? null, ["class" => "form-control"]) !!}
                        <button type="submit" class="btn btn-success">
                            Filter
                        </button>
                    </form>
                </div>
            </div>
            @if($employees->count() != 0)
                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Total Hours</th>
                                <th>Name</th>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->total_hours_day . " Hours" }}</td>
                                        <td>{{ $employee->employee->user->name }}</td>
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
