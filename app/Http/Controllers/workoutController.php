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

        $workout = new Workout();
        $workout->name = $request->name;
        $workout->description = $request->description;
        $workout->sets = $request->sets;
        $workout->reps = $request->reps;
        $workout->weight = $request->weight;
        $workout->save();

        return redirect()->route('workout.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(workout $workout)
    {
        //
    }
}
