<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'sex', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salaryHour()
    {
        return $this->hasOne(EmployeeSalaryHour::class, 'employee_id', 'id');
    }

    public static function dropdownData()
    {
        $result = [null => '- Select Employee -'];
        $data = self::orderBy('id')->get();

        foreach ($data as $row) {
            $result[$row->id] = $row->user->name;
        }

        return $result;
    }

    public function getSexTextAttribute()
    {
        if($this->sex == 'm')
            return "men";

        return "woman";
    }
}
