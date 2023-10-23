@extends('layouts.app')

<!--make a workout plan containing workouts-->
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>v
    @endif

    <!-- create a new workout plan -->
    <h1>Create a new workout plan</h1>
    <form action="{{ route('user_workouts.store') }}" method="POST">
        @csrf
        <!-- add user_id to submit -->
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="form-group">
            <label for="name">Workout Plan Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Workout Plan Description</label>
            <textarea name="description" class="form-control"> {{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="workouts">Workouts</label>
            <select name="workouts" multiple class="form-control">
                @foreach($workouts as $workout)
                    <option value="{{ $workout->id }}">{{ $workout->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

@endsection
