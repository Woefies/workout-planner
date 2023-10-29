<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class workoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);

    }

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
        return view('workouts.create', [
            'workouts' => new Workout()
        ]
        );
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
        $workout->name = $request->input('name');
        $workout->description = $request->input('description');
        $workout->sets = $request->input('sets');
        $workout->reps = $request->input('reps');
        $workout->weight = $request->input('weight');
        $workout->save();

        $workout->user()->attach(auth()->user()->id);


        return redirect()->route('workouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Workout $workout)
    {
        $workoutPlanId = $request->input('workout_plan_id');

        return view('workouts.show', [
            'workout' => $workout,
            'workoutPlanId' => $workoutPlanId, // Pass the workout plan ID to the view
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

        return redirect()->route('workouts.show' , $workout);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index');
    }

    public function toggleFavorite(Request $request, workout $workout)
    {
        $user = auth()->user();

        if ($user->favouriteUserWorkouts()->where('workout_id', $workout->id)->exists()) {
            $user->favouriteUserWorkouts()->detach($workout->id);
        } else {
            $user->favouriteUserWorkouts()->attach($workout->id);
        }

        return redirect()->route('workouts.index', $workout);
    }
}
