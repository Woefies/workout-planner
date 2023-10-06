<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class workoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('workouts.index', [
            'workouts' => Workout::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'description' => 'required',
             'sets' => 'required',
             'reps' => 'required',
             'weight' => 'required'
        ]);

        Workout::create($request->all());

        return redirect()->route('workouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(workout $workout)
    {
        return view('workouts.show', [
            'workout' => $workout,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(workout $workout)
    {
        return view('workouts.edit', [
            'workout' => $workout,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, workout $workout)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
             'sets' => 'required',
             'reps' => 'required',
             'weight' => 'required'
        ]);

        $workout = Workout::find($workout->id);
        $workout->update($request->all());

        return redirect()->route('workouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index');
    }
}
