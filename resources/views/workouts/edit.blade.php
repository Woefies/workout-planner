@extends('layouts.app')

@section('content')
    <form action="{{ route('workouts.update', $workout->id) }}" method="post" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $workout->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description"  class="form-control">{{ $workout->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="sets">Sets</label>
            <input type="number" name="sets" value="{{ $workout->sets }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="reps">Reps</label>
            <input type="number" name="reps" value="{{ $workout->reps }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" value="{{ $workout->weight }}" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">update</button>
        </div>
        <div class=""></div>
    </form>
@endsection

