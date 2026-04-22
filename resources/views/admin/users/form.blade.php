@props(['user' => null])

<div class="space-y-6">
    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user?->name) }}" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            @error('name')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user?->email) }}" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="role" class="block text-sm font-medium text-gray-200">Role</label>
            <select name="role" id="role" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select role</option>
                @foreach(['admin', 'teacher', 'student'] as $roleOption)
                    <option value="{{ $roleOption }}" {{ old('role', $user?->role) === $roleOption ? 'selected' : '' }}>{{ ucfirst($roleOption) }}</option>
                @endforeach
            </select>
            @error('role')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div id="classroom-field" style="{{ old('role', $user?->role) === 'student' ? '' : 'display: none;' }}">
            <label for="classroom_id" class="block text-sm font-medium text-gray-200">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select classroom</option>
                @foreach(\App\Models\Classroom::orderBy('name')->get() as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id', $user?->classroom?->id) == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                @endforeach
            </select>
            @error('classroom_id')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" {{ isset($user) ? '' : 'required' }} />
            <p class="mt-1 text-sm text-gray-400">{{ isset($user) ? 'Leave blank to keep current password.' : 'Minimum 8 characters.' }}</p>
            @error('password')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" {{ isset($user) ? '' : 'required' }} />
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">Save</button>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-300 hover:text-white">Back to user list</a>
    </div>
</div>
<script>
document.getElementById('role').addEventListener('change', function() {
    const classroomField = document.getElementById('classroom-field');
    if (this.value === 'student') {
        classroomField.style.display = 'block';
    } else {
        classroomField.style.display = 'none';
    }
});
</script>