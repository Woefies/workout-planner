@extends('layouts.app')

<!-- add the workout through foreach -->
@section('content')
    <!-- create new workout button -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('workouts.create') }}" class="btn btn-primary">Create Workout</a>
            </div>
        </div>

    <!-- show all workouts -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($workouts as $workout)
                    <div class="card">
                        <div class="card-header">{{ $workout->name }}</div>

                        <div class="card-body">
                            <p>{{ $workout->description }}</p>
                            <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-primary">View</a>
                            @if(Auth::user()->id == $workout->user_id)
                                <!-- edit button -->
                                <a href="{{ route('workouts.edit', $workout->id) }}" class="btn btn-primary">Edit</a>
                                <!-- delete button -->
                                <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
