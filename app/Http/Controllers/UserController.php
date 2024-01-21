<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display_all()
    {
        //admin only
        if (!auth()->user()->is_admin) {
            return redirect()->route('user.index')->with('error', 'You are not authorized to view this page.');
        }

        $users = User::all();
        return view('users.display_all', [
            'users' => $users,
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('users.index', [
            'user' => $user,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (auth()->user()->is_admin || auth()->user()->id === $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('user.index')->with('error', 'You are not authorized to edit this profile.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check if the user is an admin or the correct user
        if (!auth()->user()->is_admin && auth()->user()->id !== $user->id) {
            return redirect()->route('user.index')->with('error', 'You do not have permission to edit this profile.');
        }


        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        if (auth()->user()->is_admin) {
            return redirect()->route('users.display_all')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('user.index')->with('success', 'Profile updated successfully.');
        }

    }

    public function favoriteWorkouts(User $user)
    {
        $workouts = $user->favouriteUserWorkouts()->get();
        return view('users.index', [
            'workouts' => $workouts,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.display_all');
    }

}
