<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);

        return view('student.profile.show', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = auth()->user();
        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);

        return view('student.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($profile->avatar && Storage::exists('public/avatars/' . $profile->avatar)) {
                Storage::delete('public/avatars/' . $profile->avatar);
            }

            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);
            $validated['avatar'] = $avatarName;
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('student.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function destroyAvatar()
    {
        $user = auth()->user();
        $profile = $user->studentProfile;

        if ($profile && $profile->avatar) {
            if (Storage::exists('public/avatars/' . $profile->avatar)) {
                Storage::delete('public/avatars/' . $profile->avatar);
            }

            $profile->update(['avatar' => null]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}