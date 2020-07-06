<?php

namespace App\Policies;

use App\User;
use App\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function onlyadmin(User $user)
    {
        return $user->id == 1;
    }

    public function update(User $user, Employee $employee)
    {
        return $user->id == 1;
    }

    public function delete(User $user, Employee $employee)
    {
        return $user->id == 1;
    }

    public function attendance(User $user, Employee $employee)
    {
        return $user->id == $employee->user_id;
    }

    public function mysalary(User $user, Employee $employee)
    {
        return $user->id == $employee->user_id;
    }
}
