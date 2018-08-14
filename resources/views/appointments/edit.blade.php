@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group row">
                    <label for="task" class="col-md-4 col-form-label text-md-right">Task:</label>
                    <div class="col-md-6">
                        <input id="task" type="text" class="form-control{{ $errors->has('task') ? ' is-invalid' : '' }}" name="task" value="{{ old('task', $appointment->task) }}" required autofocus>

                        @if ($errors->has('task'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('task') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label text-md-right">Status:</label>
                    <div class="col-md-6">
                        <select name="status">
                            <option value="Pending" @if (strcmp('Pending', $appointment->status)==0) {{ "selected"}} @endif >Pending</option>
                            <option value="Done" @if (strcmp('Done', $appointment->status)==0) {{ "selected"}} @endif >Done</option>
                            <option value="Missed" @if (strcmp('Missed', $appointment->status)==0) {{ "selected"}} @endif >Missed</option>
                        </select>

                        @if ($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="task_date" class="col-md-4 col-form-label text-md-right">Date:</label>

                    <div class="col-md-6">
                        <input id="task_date" type="date" min="{{ \Carbon\Carbon::now()->toDateString() }}" class="form-control{{ $errors->has('task_date') ? ' is-invalid' : '' }}" name="task_date" value="{{ old('task_date', $appointment->task_date) }}" required autofocus>

                        @if ($errors->has('task_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('task_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="task_time" class="col-md-4 col-form-label text-md-right">Time:</label>
                    <div class="col-md-6">
                        <input id="task_time" type="time" class="form-control{{ $errors->has('task_time') ? ' is-invalid' : '' }}" name="task_time" value="{{ old('task_time', $appointment->task_time) }}" required autofocus>

                        @if ($errors->has('task_time'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('task_time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
