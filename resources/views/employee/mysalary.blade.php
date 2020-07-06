@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($employees->count() != 0)
                <div class="card-header">My Salary</div>
                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Hours Worked</th>
                                <th>Date</th>
                                <th>Salary</th>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->total_hours_day }}</td>
                                        <td>{{ Carbon\Carbon::parse($employee->start_date)->format('d M Y') }}</td>
                                        <td>{{ $employee->my_salary_today }}</td>
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
