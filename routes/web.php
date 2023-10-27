<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/workouts/{workout}', 'WorkoutController@show')->name('workouts.show');
Route::resource('workouts', \App\Http\Controllers\workoutController::class);
Route::post('/workouts/{workout}', [\App\Http\Controllers\workoutController::class, 'toggleFavorite'])->name('workouts.toggleFavorite');
//Route::resource('user_workouts', \App\Http\Controllers\UserWorkoutController::class);
Route::resource('workout_plans', \App\Http\Controllers\WorkoutPlansController::class);
