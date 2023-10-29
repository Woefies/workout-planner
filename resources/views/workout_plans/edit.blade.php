@extends('layouts.app')

@section('content')
    <!-- workout plans edit page -->

    <form action="{{route('workout_plans.update', ['workout_plan' => $workout_plans->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Workout Plan Name</label>
            <input type="text" name="name" value="{{ $workout_plans->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Workout Plan Description</label>
            <textarea name="description"  class="form-control">{{ $workout_plans->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="workout">Workout</label>
            <select name="workout[]" multiple class="form-control">
                @foreach($workouts as $workout)
                    <option value="{{ $workout->id }}" {{ in_array($workout->id, $workout_plans->workout->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $workout->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">update</button>
        </div>

    </form>
@endsection
