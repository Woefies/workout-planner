@extends('layouts.app')

@section('content')
    <section>
        <!-- view all users accounts (admin only)-->
        @if (Auth::check() && $user->is_admin === 1)
        <a class="btn btn-primary" href="{{ route('users.display_all') }}">All users</a>
        @endif


        <h1 class="is-flex is-center m-3"> {{ $user->name }} </h1>
        <div class="row m-1">
                <div class="col-md-3">
                    <div class="box m-1">
                        <ul>

                            <li>Email: <strong>{{ $user->email }}</strong></li>
                            @if (Auth::check() && $user->is_admin === 1)
                                <li>Admin: {{ $user->is_admin }}</li>
                            @endif
                        </ul>
                    </div>
                    <!-- edit button -->
                    <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">edit</a>
                </div>
            <!-- shows all user favorite workouts in a list-->
            <h1 class="is-flex is-center m-3">  Favorites ({{ count(Auth::user()->favouriteUserWorkouts) }})</h1>
            @foreach(Auth::user()->favouriteUserWorkouts as $favouriteUserWorkout)
                <div class="card">
                    <div class="card-header">
                        <h3>
                        <a class="" href="{{ route('workouts.show', [$favouriteUserWorkout->id, 'userId' => $user->id]) }}">{{ $favouriteUserWorkout->name }}</a>
                        </h3>
                    </div>
                    <div class="card-body">
                            <p>Description: {{ $favouriteUserWorkout->description ?? 'Uncategorized' }}</p>
                    </div>
                </div>

            @endforeach
        </div>
    </section>
@endsection
