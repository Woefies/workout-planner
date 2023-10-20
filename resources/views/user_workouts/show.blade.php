@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- show the workout details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user_workout->name }}</div>

                    <div class="card-body">
                        <p>{{ $user_workout->description }}</p>
                        <!-- list workouts that are in this workout plan -->
                        <ul>
                            @foreach($user_workout->workouts as $workout)
                                <li>{{ $workout->name }}</li>
                            @endforeach
                        </ul>
                        <!-- edit button -->
                        <a href="{{ route('user_workouts.edit', $user_workout->id) }}" class="btn btn-primary">Edit</a>
                        <!-- delete button -->
                        <form action="{{ route('user_workouts.destroy', $user_workout->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        <!-- return to index -->
                        <a href="{{ route('user_workouts.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
