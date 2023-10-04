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
                        <a href="{{ route('workouts.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
