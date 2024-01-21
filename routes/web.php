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

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::post('/workouts/{workout}', [\App\Http\Controllers\workoutController::class, 'toggleFavorite'])->name('workouts.toggleFavorite');
Route::resource('workout_plans', \App\Http\Controllers\WorkoutPlanController::class);
Route::resource('workouts', \App\Http\Controllers\workoutController::class);
Route::resource('user', \App\Http\Controllers\UserController::class);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'display_all'])->name('users.display_all'); // Display all users
