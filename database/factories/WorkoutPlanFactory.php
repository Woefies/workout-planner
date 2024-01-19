<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkoutPlan>
 */
class WorkoutPlanFactory extends Factory
{
    protected $model = WorkoutPlan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'user_id' => User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (WorkoutPlan $workoutPlan) {
            $faker = app(Faker::class);
            $workoutIds = Workout::pluck('id')->toArray();

            $workoutPlan->workout()->attach(
                Arr::random($workoutIds, $faker->numberBetween(3, 10)),
                ['created_at' => now(), 'updated_at' => now()]
            );
        });
    }
}
