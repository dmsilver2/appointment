@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hello, {{ $name }}!</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Here are your appointments for today, {{ \Carbon\Carbon::now()->format("F d Y") }}</p>
            <table class="table table-striped table-bordered">
                <tr>
                    <th scope="col">Tasks</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                @foreach ($todaysAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->task }}</td>
                        <td>{{ $appointment->task_time }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            @if (strcmp($appointment->status, 'Done') != 0)
                                <a href="{{ route('appointments.edit', $appointment->id) }} ">Edit</a>
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <br />
            <p>Your Other appointments</p>
            <table class="table table-striped table-bordered">
                <tr>
                    <th scope="col">Tasks</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                </tr>
                @foreach ($futureAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->task }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->task_date)->format("F d") }}</td>
                        <td>{{ $appointment->task_time }}</td>
                    </tr>
                @endforeach
            </table>
            <br />
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="task_date" class="col-md-4 col-form-label text-md-right">Date:</label>

                    <div class="col-md-6">
                        <input id="task_date" type="date" min="{{ \Carbon\Carbon::now()->toDateString() }}" class="form-control{{ $errors->has('task_date') ? ' is-invalid' : '' }}" name="task_date" value="{{ old('task_date') }}" required autofocus>

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
                        <input id="task_time" type="time" class="form-control{{ $errors->has('task_time') ? ' is-invalid' : '' }}" name="task_time" value="{{ old('task_time') }}" required autofocus>

                        @if ($errors->has('task_time'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('task_time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="task" class="col-md-4 col-form-label text-md-right">Task:</label>
                    <div class="col-md-6">
                        <input id="task" type="text" class="form-control{{ $errors->has('task') ? ' is-invalid' : '' }}" name="task" value="{{ old('task') }}" required autofocus>

                        @if ($errors->has('task'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('task') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
