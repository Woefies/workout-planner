<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'sets',
        'reps',
        'weight',
        'active',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsToMany(User::class, 'user_workouts');
    }

    /**
     * Get the workout_plans that have this workout.
     */
    public function workoutplan()
    {
        return $this->belongsToMany(WorkoutPlan::class, 'workout_plan_workout');
    }




}
