<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        // $posts = $user->posts()->latest()->paginate();
        $posts = $user->posts()->withCount('claps')->latest()->simplePaginate(10);
        return view('profile.show', compact('user', 'posts'));
    }
}
