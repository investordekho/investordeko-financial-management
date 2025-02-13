<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile settings view.
     */
    public function showProfileSettings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    /**
     * Update profile settings.
     */
    public function updateProfileSettings(Request $request)
    {
        $user = Auth::user();

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user's basic information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');

            // Delete the old image if it exists
            if ($user->profile_image && Storage::disk('public')->exists('profile_image/' . $user->profile_image)) {
                Storage::disk('public')->delete('profile_image/' . $user->profile_image);
            }

            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $profileImage->getClientOriginalExtension();

            // Store the new image in the public/profile_image directory
            $profileImage->storeAs('profile_image', $filename, 'public');

            // Update the user's profile image filename in the database
            $user->profile_image = $filename;
        }

        // Save updated user details
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile.settings')->with('success_message', 'Profile updated successfully.');
    }
}
