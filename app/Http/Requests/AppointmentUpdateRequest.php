<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_date' => 'required|after_or_equal:' . Carbon::now()->toDateString(),
            'task_time' => 'required|uniqueTaskDateAndTime:'. $this->task_date . ',' .
                            Auth::id() .',' . $this->route('appointment')->id,
            'task' => 'required|string|between:3,25',
            'status' => 'required|in:Pending,Done,Missed',
        ];
    }
}
