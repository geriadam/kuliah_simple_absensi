<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryHour extends Model
{
    protected $fillable = ['employee_id', 'salary_hours'];
    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
