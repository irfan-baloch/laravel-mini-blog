<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicUserController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        //only fetch published posts
        $posts = $user->posts()
                      ->where('status', 'published')
                      ->latest()
                      ->paginate(5);
                      
        $comments = $user->comments()->latest()->take(5)->get();

        return view('public.profile', compact('user', 'posts', 'comments'), [
            'user'              => $user,
            'posts'             => $posts,
            'comments'          => $comments,
            'metaTitle'         => $user->name . ' - Profile | ' . config('app.name'),
            'metaDescription'   => 'Ceck out posts and bio from ' . $user->name,
        ]);
    }
}
