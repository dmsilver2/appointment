<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointments.index', [
            'todaysAppointments' => Appointment::todaysAppointments(),
            'futureAppointments' => Appointment::futureAppointments(),
            'name' => Auth::user()->name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AppointmentStoreRequest $saveRequest
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentStoreRequest $saveRequest)
    {
        Appointment::create([
            'task' => $saveRequest->task,
            'task_date' => $saveRequest->task_date,
            'task_time' => $saveRequest->task_time,
            'user_id' => Auth::id()
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\AppointmentUpdateRequest  $updateRequest
     * @param  App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentUpdateRequest $updateRequest, Appointment  $appointment)
    {
        $appointment->update($updateRequest->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment  $appointment)
    {
        $appointment->delete();

        return redirect()->back();
    }
}
