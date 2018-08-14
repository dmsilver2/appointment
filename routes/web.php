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

Route::get('/appointments', 'AppointmentsController@index')->name('appointments.index');
Route::post('/appointments/create', 'AppointmentsController@store')->name('appointments.store');

Route::middleware(['can:access-appointment,appointment'])->group(function () {
    Route::get('/appointments/{appointment}', 'AppointmentsController@edit')->name('appointments.edit');
    Route::put('/appointments/{appointment}', 'AppointmentsController@update')->name('appointments.update');
    Route::delete('/appointments/{appointment}', 'AppointmentsController@destroy')->name('appointments.destroy');
});
