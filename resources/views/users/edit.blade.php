@extends('layouts.app')

@section('content')

    <!-- edit form -->
    <form action="{{ route('user.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">email:</label>
            <input type="text" name="email" value="{{ $user->email }}" class="form-control">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>


    </form>
@endsection
