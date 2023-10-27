@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

{{--                <!-- show workouts that the user made -->--}}

{{--                <div class="card-body">--}}
{{--                    <h1>My Workouts</h1>--}}
{{--                    @foreach($workouts as $workout)--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">{{ $workout->name }}</div>--}}

{{--                            <div class="card-body">--}}
{{--                                <p>{{ $workout->description }}</p>--}}
{{--                                <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-primary">View</a>--}}
{{--                                @auth--}}
{{--                                @if(Auth::user()->id === $workout->user_id || Auth::user()-> is_admin == 1 )--}}
{{--                                    <!-- edit button -->--}}
{{--                                    <a href="{{ route('workouts.edit', $workout->id) }}" class="btn btn-primary">Edit</a>--}}
{{--                                    <!-- delete button -->--}}
{{--                                    <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
{{--                                @endauth--}}
{{--                                @if(auth()->check())--}}
{{--                                    @if(Auth::user()->favouriteUserWorkouts->contains($workout))--}}
{{--                                        <form action="{{ route('workouts.toggleFavorite', $workout->id) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            <button class="button is-warning" type="submit">Un-Favorite</button>--}}
{{--                                        </form>--}}
{{--                                    @else--}}
{{--                                        <form action="{{ route('workouts.toggleFavorite', $workout->id) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" class="btn btn-primary">Favourite</button>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                @endforeach--}}

            </div>
        </div>
    </div>
</div>
@endsection
