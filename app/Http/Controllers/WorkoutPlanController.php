<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
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
            'workout_plans' => WorkoutPlan::all(),
            'workouts' => Workout::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workout_plans.create', [
            'workout_plans' => new WorkoutPlan(),
            'workouts' => Workout::all(),
                'user' => Auth::user(),
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
                'user_id' => 'required'
            ]);

            $workout_plans = new WorkoutPlan();
            $workout_plans->name = $request->input('name');
            $workout_plans->description = $request->input('description');
            $workout_plans->user_id = $request->input('user_id');
            $workout_plans->save();

            $workout_plans->workout()->attach($request->input('workouts'));

            return redirect()->route('workout_plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkoutPlan $workout_plan, Workout $workout)
    {
        return view('workout_plans.show', [
            'workout_plans' => $workout_plan,
            'workout' => $workout,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkoutPlan $workout_plan)
    {
        $workout_plan = $workout_plan->with('workout')->find($workout_plan->id);

        return view('workout_plans.edit', [
            'workout_plans' => $workout_plan,
            'workouts' => $workout_plan->workout,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkoutPlan $workout_plans)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'workouts' => 'array',

        ]);

        $workout_plans->name = $request->input('name');
        $workout_plans->description = $request->input('description');
        $workout_plans->update();

        $workout_plans->workout()->sync($request->input('workouts'));

        return redirect()->route('workout_plans.index', $workout_plans);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutPlan $workout_plans)
    {
        $workout_plans->workout()->detach();
        $workout_plans->delete();

        return redirect()->route('workout_plans.index');
    }
}
