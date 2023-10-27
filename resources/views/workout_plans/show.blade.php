@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- show the workout details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $workout_plans->name }}</div>

                    <div class="card-body">
                        <p>{{ $workout_plans->description }}</p>
                        @if ($workout_plans->workout)
                            <ul>
                                @forelse ($workout_plans->workout as $workout)
                                    <li>
                                        <a href="{{ route('workouts.show', ['workout' => $workout->id, 'workout_plan_id' => $workout_plans->id]) }}">
                                            {{ $workout->name }}
                                        </a>

                                    </li>
                                @empty
                                    <li>No workouts available for this plan.</li>
                                @endforelse
                            </ul>
                        @else
                            <p>No workout plan selected.</p>
                        @endif
                        @auth
                            @if(Auth::user()->id === $workout->user_id || Auth::user()-> is_admin == 1 )
                        <!-- edit button -->
                        <a href="{{ route('workout_plans.edit', $workout_plans->id) }}" class="btn btn-primary">Edit</a>

                        <!-- delete button -->
                        <form action="{{ route('workout_plans.destroy', $workout_plans->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            @endif
                        @endauth

                        <!-- return to index -->
                        <a href="{{ route('workout_plans.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
