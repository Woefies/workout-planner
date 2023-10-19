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
                        <!-- edit button -->
                        <a href="{{ route('workouts.edit', $workout->id) }}" class="btn btn-primary">Edit</a>
                        <!-- delete button -->
                        <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        <!-- return to index -->
                        <a href="{{ route('workouts.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
