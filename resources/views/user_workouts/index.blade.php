@extends('layouts.app')

<!-- make a workout plan -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

            <!-- create new workout plan button -->
            <a href="{{ route('user_workouts.create') }}" class="btn btn-primary">Create Workout plan</a>

            <!-- show all workout plans -->
            @foreach($user_workouts as $user_workout)
                <div class="card">
                    <div class="card-header">{{ $user_workout->name }}</div>

                    <div class="card-body">
                        <p>{{ $user_workout->description }}</p>
                        <a href="{{ route('user_workouts.show', $user_workout->id) }}" class="btn btn-primary">View</a>
                        <!-- edit button -->
                        <a href="{{ route('user_workouts.edit', $user_workout->id) }}" class="btn btn-primary">Edit</a>
                        <!-- delete button -->
                        <form action="{{ route('user_workouts.destroy', $user_workout->id) }}" method="POST">
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
