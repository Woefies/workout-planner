<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class workoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query = $request->input('query', '');

        if (Auth::check()) {
            $user = Auth::user();
            $workoutQuery = $user->is_admin ? Workout::query() : Workout::where('active', true);
        } else {
            $workoutQuery = Workout::where('active', true);
        }

        //apply the name and description filter
        $workoutQuery->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        });

        //sort oder
        $workoutQuery->orderBy($sortBy, $sortOrder);

        $workouts = $workoutQuery->get();

        return view('workouts.index', [
            'workouts' => $workouts,
            'query' => $query,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = Auth::user();
        $favoriteWorkoutCount = $user->favouriteUserWorkouts()->count();

        if ($favoriteWorkoutCount >= 3 || $user->is_admin) {
            return view('workouts.create', [
                    'workouts' => new Workout(),
                    'user' => Auth::user(),
                ]
            );
        } else {
            return redirect()->route('workouts.index')
                ->with('error', 'You need at least 3 favourite workouts before making one')
                ->with('showPopup', true);

        }
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
             'weight' => 'required',
             'user_id' => 'required'
        ]);

        $workout = new Workout();
        $workout->name = $request->input('name');
        $workout->description = $request->input('description');
        $workout->sets = $request->input('sets');
        $workout->reps = $request->input('reps');
        $workout->weight = $request->input('weight');
        $workout->user_id = $request->input('user_id');
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

        $workout->name = $request->input('name');
        $workout->description = $request->input('description');
        $workout->sets = $request->input('sets');
        $workout->reps = $request->input('reps');
        $workout->weight = $request->input('weight');
        $workout->active = $request->has('active');
        $workout->save();

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

    public function toggleActive(Request $request, Workout $workout)
    {
        $workout->active = $request->has('active');
        $workout->save();

        return redirect()->route('workouts.index');
    }

public function active(Workout $workout)
    {
        $request = new Request();
        $workout->active = $request->has('active');
        $workout->save();

        return redirect()->route('workouts.index');
    }

}
