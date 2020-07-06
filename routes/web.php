<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route Menu Employee
Route::prefix('employee')
    ->name('employee.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', 'EmployeeController@index')->name('index');
        Route::get('create', 'EmployeeController@create')->name('create');
        Route::post('', 'EmployeeController@store')->name('store');
        Route::get('{employee}/edit', 'EmployeeController@edit')->name('edit');
        Route::put('{employee}', 'EmployeeController@update')->name('update');
        Route::get('{employee}/destroy', 'EmployeeController@destroy')->name('destroy');
        Route::get('{employee}/attendance', 'EmployeeController@attendance')->name('attendance');
        Route::get('{employee}/mysalary', 'EmployeeController@mysalary')->name('mysalary');
    });

// Route Menu Employee Attendance
Route::prefix('employee_attendance')
    ->name('employee_attendance.')
    ->group(function () {
        Route::get('', 'EmployeeAttendanceController@index')->name('index');
    });
