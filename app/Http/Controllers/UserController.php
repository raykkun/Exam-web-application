<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Result;
use App\Models\User;
use App\Models\ClassUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('classroom')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,teacher,student',
            'password' => 'required|string|min:8|confirmed',
            'classroom_id' => 'nullable|exists:classrooms,id',
        ]);

        $classroomId = $validated['classroom_id'];
        unset($validated['classroom_id']);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        // Assign student to classroom if provided and role is student
        if ($classroomId && $validated['role'] === 'student') {
            ClassUser::create([
                'user_id' => $user->id,
                'classroom_id' => $classroomId,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load('classroom');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('classroom');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,teacher,student',
            'password' => 'nullable|string|min:8|confirmed',
            'classroom_id' => 'nullable|exists:classrooms,id',
        ]);

        $classroomId = $validated['classroom_id'];
        unset($validated['classroom_id']);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        // Update classroom assignment for students
        if ($validated['role'] === 'student') {
            ClassUser::updateOrCreate(
                ['user_id' => $user->id],
                ['classroom_id' => $classroomId]
            );
        } else {
            // Remove classroom assignment if role is not student
            ClassUser::where('user_id', $user->id)->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
