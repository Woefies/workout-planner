@extends('layouts.app')

<!-- make a workout plan -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

            <!-- create new workout plan button -->
                @if(auth()) @endif
            <a href="{{ route('workout_plans.create') }}" class="btn btn-primary">Create Workout plan</a>

            <!-- show all workout plans -->
            @foreach($workout_plans as $workout_plan)
                <div class="card">
                    <div class="card-header">{{ $workout_plan->name }}</div>

                    <div class="card-body">
                        <p>{{ $workout_plan->description }}</p>
                        <a href="{{ route('workout_plans.show', $workout_plan->id) }}" class="btn btn-primary">View</a>

                        <a href="{{ route('workout_plans.edit', $workout_plan->id) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('workout_plans.destroy', $workout_plan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
@endsection
