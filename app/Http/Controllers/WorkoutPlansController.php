<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Workout_plans;
use Illuminate\Http\Request;

class WorkoutPlansController extends Controller
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
        return view('workout_plans.index', [
            'workout_plans' => Workout_plans::all(),
            'workouts' => Workout::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workout_plans.create', [
            'workout_plans' => new Workout_plans(),
            'workouts' => Workout::all()
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
                'workouts' => 'array',
            ]);

            $workout_plans = new Workout_plans();
            $workout_plans->name = $request->input('name');
            $workout_plans->description = $request->input('description');
            $workout_plans->save();

            $workout_plans->workout()->attach($request->input('workouts'));

            return redirect()->route('workout_plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout_plans $workout_plan, Workout $workout)
    {
        return view('workout_plans.show', [
            'workout_plans' => $workout_plan,
            'workout' => $workout,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout_plans $workout_plans, Workout $workout)
    {
        return view('workout_plans.edit', [
            'workout_plans' => $workout_plans,
            'workout' => $workout,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout_plans $workout_plans, Workout $workout)
    {
        return view('workout_plans.index', [
            'workout_plans' => $workout_plans,
            'workout' => $workout,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout_plans $workout_plans)
    {
        $workout_plans->delete();

        return redirect()->route('workout_plans.index');
    }
}
