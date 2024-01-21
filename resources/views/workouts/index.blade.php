@extends('layouts.app')


@section('content')
    <!-- create new workout button -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('workouts.create') }}" class="btn btn-primary">Create Workout</a>
            </div>
        </div>

        <form action="{{ route('workouts.index') }}" method="GET" class=" d-flex align-items-center form-inline w-100">
            <div class="form-group ml-2 mr-2 mb-2 is-flex ">
                <input type="text" name="query" class="form-control w-100" placeholder="Search workouts..." value="{{ $query }}">
            </div>

            <div class="form-group mr-2 mb-2">
                <select name="sort_by" class="form-control">
                    <option value="created_at" {{ $sort_by == 'created_at' ? 'selected' : '' }}>Created at</option>
                    <option value="name" {{ $sort_by == 'name' ? 'selected' : '' }}>name</option>

                </select>
            </div>

            <div class="form-group mr-2 mb-2">
                <select name="sort_order" class="form-control">
                    <option value="desc" {{ $sort_order == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ $sort_order == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary mb-2 ml-2">Search</button>
        </form>








    <!-- show all workouts -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($workouts as $workout)
                    <div class="card">
                        <div class="card-header">{{ $workout->name }}</div>

                        <div class="card-body">
                            <p>{{ $workout->description }}</p>
                            @if(Auth::check())
                                @if(Auth::user()->is_admin)
                                    <p class="is-flex ">is workout active: {{$workout->active}}</p>
                                @endif
                            @endif
                            <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-primary">View</a>
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
                            @if(auth()->check())
                                @if(Auth::user()->favouriteUserWorkouts->contains($workout))
                                    <form action="{{ route('workouts.toggleFavorite', $workout->id) }}" method="POST">
                                        @csrf
                                        <button class="button is-warning" type="submit">Un-Favorite</button>
                                    </form>
                                @else
                                    <form action="{{ route('workouts.toggleFavorite', $workout->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Favourite</button>
                                    </form>
                                @endif
                            @endif


                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
