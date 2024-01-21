@extends('layouts.app')

<!-- show the workout details -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $workout->name }}</div>

                    <div class="card-body">
                        <p>{{ $workout->description }}</p>
                        <p>Sets: {{ $workout->sets }}</p>
                        <p>Reps: {{ $workout->reps }}</p>
                        <p>Weight: {{ $workout->weight }}</p>
                        @auth
                            @if(Auth::user()->id === $workout->user_id || Auth::user()-> is_admin == 1 )
                        <!-- edit button -->
                        <a href="{{ route('workouts.edit', $workout->id) }}" class="btn btn-primary">Edit</a>
                        <!-- delete button -->
                        <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            @endif
                        @endauth

                        <!-- return to index -->
                        <a href="{{ route('workouts.index') }}" class="btn btn-primary">back to workouts</a>
                        @if(isset($workoutPlanId))
                            <a href="{{ route('workout_plans.show', ['workout_plan' => $workoutPlanId]) }}">Back to Workout Plan</a>
                        @endif
                        @if(isset($userId))
                            <a href="{{ route('user.index') }}">Back to profile</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
