<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    protected $fillable = ['task', 'task_date', 'task_time', 'user_id', 'status'];

    protected function todaysAppointments()
    {
        return $this::where('user_id', Auth::id())
                      ->where('task_date', Carbon::now()->toDateString())
                      ->orderby('task_time', "asc")->get();
    }


    protected function futureAppointments()
    {
        return $this::where('user_id', Auth::id())
                      ->where('task_date', '>', Carbon::now()->toDateString())
                      ->orderby('task_date', "asc")->get();
    }
}
