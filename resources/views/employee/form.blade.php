@extends('layouts.app')
@section('content')
@include('layouts.header-form', ['back' => 'employee.index', 'create' => 'employee.store', 'update' => 'employee.update', 'data' => $employee ?? null])
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="position-relative form-group">
                        <label class="">Email</label>
                        {!! Form::text('email', $employee->user->email ?? null, ["class" => "form-control"]) !!}
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Password</label>
                        {!! Form::password('password', [
                            "class" => "form-control password-change",
                            "autocomplete" => "off",
                            "readonly" => "readonly",
                            "onfocus" => "this.removeAttribute('readonly');"
                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="position-relative form-group">
                        <label>NIP</label>
                        {!! Form::text('nip', $employee->user->nip ?? null, ["class" => "form-control"]) !!}
                    </div>
                    <div class="position-relative form-group">
                        <label>Name</label>
                        {!! Form::text('name', $employee->user->name ?? null, ["class" => "form-control"]) !!}
                    </div>
                    <div class="position-relative form-group">
                        {!! Form::radio('sex', "m", isset($employee) && $employee->sex == 'm' ? true : false, ["data-toggle" =>"toggle", "data-size" => "mini"]) !!} Man
                        {!! Form::radio('sex', "w", isset($employee) && $employee->sex == 'w' ? true : false, ["data-toggle" =>"toggle", "data-size" => "mini"]) !!} Woman
                    </div>
                    <div class="position-relative form-group">
                        <label>Address</label>
                        {!! Form::textarea('address', $employee->address ?? null, ["class" => "form-control"]) !!}
                    </div>
                    <div class="position-relative form-group">
                        <label>Salary/Hour</label>
                        {!! Form::number('salary_hours', $employee->salaryHour->salary_hours ?? null, ["class" => "form-control"]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
