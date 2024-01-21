@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($users as $user)
                        <!-- show all users -->
                        <div class="card-header">{{ $user->name }}</div>

                        <div class="card-body">
                            <p>email: {{ $user->email }}</p>
                            <p>ID: {{ $user->id }}</p>
                            <p>Admin: {{ $user->is_admin }}</p>
                            <p>created: {{ $user->created_at }}</p>
                            <p>updated: {{ $user->updated_at }}</p>
                            @auth
                                @if(Auth::user()->id === $user->id || Auth::user()-> is_admin == 1 )
                            <!-- edit button -->
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <!-- delete button -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
