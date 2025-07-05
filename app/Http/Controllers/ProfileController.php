<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username,'.$user->id,
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'bio'       => 'nullable|string|max:1000',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $user->fill($request->only('name', 'username', 'email', 'bio'));

        if ($request->hasFile('avatar')) {
            // Delete old image
            if ($user->avatar && Storage::disk('public')->exists('avatars/'. $user->avatar)) {
                Storage::disk('public')->delete('avatars/'. $user->avatar);
            }
            // Save new image
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('avatars', $file, $filename);
        }

        $user->avatar = $filename;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dashboard()
    {
        return view('profile.dashboard');
    }
}
