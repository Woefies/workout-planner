<?php

namespace App\Http\Controllers;

use App\Models\User_workout;
use App\Models\Workout;
use Illuminate\Http\Request;

class UserWorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user_workouts.index', [
            'user_workouts' => User_workout::all(),
            'workouts' => Workout::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                'workout_id' => 'required'
            ]);

            User_workout::create($request->all());

            return redirect()->route('user_workouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User_workout $user_workout, Workout $workout)
    {
        return view('user_workouts.show', [
            'user_workout' => $user_workout,
            'workout' => $workout,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_workout $user_workout, Workout $workout)
    {
        return view('user_workouts.edit', [
            'user_workout' => $user_workout,
            'workout' => $workout,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User_workout $user_workout)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'workout_id' => 'required'
        ]);

        $user_workout = User_workout::find($user_workout->id);
        $user_workout->update($request->all());

        return redirect()->route('user_workouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_workout $user_workout)
    {
        $user_workout->delete();

        return redirect()->route('user_workouts.index');
    }
}
