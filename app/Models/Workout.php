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

    /**
     * Get the users that have this workout.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the userworkouts that have this workout.
     */
    public function user_workouts()
    {
        return $this->hasMany(User_workout::class);
    }

}
