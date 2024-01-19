@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- create a new workout -->
    <h1>Create a new workout</h1>
    <form action="{{ route('workouts.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" value="{{ old('description') }}" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="sets">Sets</label>
            <input type="number" name="sets" value="{{ old('sets') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="reps">Reps</label>
            <input type="number" name="reps" value="{{ old('reps') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" value="{{ old('weight') }}" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    <!-- return to index -->
    <a href="{{ route('workouts.index') }}" class="btn btn-primary">Back</a>
@endsection
