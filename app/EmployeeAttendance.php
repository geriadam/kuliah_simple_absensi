<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    protected $fillable = ['employee_id', 'start_date', 'end_date'];
    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getTotalHoursDayAttribute()
    {
        if(!is_null($this->start_date) && !is_null($this->end_date))
        {
            $start = Carbon::parse($this->start_date);
            $end   = Carbon::parse($this->end_date);

            return $start->diffInHours($end);
        }

        return null;
    }

    public function getMySalaryTodayAttribute()
    {
        if(!is_null($this->total_hours_day)){
            return $this->total_hours_day * optional($this->employee->salaryHour)->salary_hours;
        }

        return null;
    }
}
