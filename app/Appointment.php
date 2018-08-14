<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = ['task', 'task_date', 'task_time', 'user_id', 'status'];

    protected function todaysAppointments()
    {
        return $this::where('task_date', '=', Carbon::now()->toDateString())
                    ->orderby('task_time', "asc")->get();
    }


    protected function futureAppointments()
    {
        return $this::where('task_date', '>', Carbon::now()->toDateString())
                    ->orderby('task_date', "asc")->get();
    }
}
