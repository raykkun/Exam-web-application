<x-layout title="Edit Profile">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">Edit Profile</h2>
        <p class="text-sm text-gray-400">Update your personal information and preferences.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-lg border border-red-700 bg-red-900/80 p-4 text-red-100">
            <p class="font-semibold">Please fix the following errors:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-700 bg-green-900/80 p-4 text-green-100">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-white mb-4">Profile Picture</h3>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/avatars/' . $profile->avatar) }}" alt="Profile Picture" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500">
                    @else
                        <div class="w-20 h-20 rounded-full bg-indigo-600 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex items-center space-x-4">
                        <label for="avatar" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-200 bg-slate-800 hover:bg-slate-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Change Photo
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                        </label>
                        @if($profile->avatar)
                            <button type="button" onclick="removeAvatar()" class="inline-flex items-center px-4 py-2 border border-red-600 rounded-md shadow-sm text-sm font-medium text-red-200 bg-red-900 hover:bg-red-800">
                                Remove
                            </button>
                        @endif
                    </div>
                    <p class="mt-2 text-sm text-gray-400">JPG, PNG or GIF. Max size 2MB.</p>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-white mb-4">Personal Information</h3>
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-200">Phone Number</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    @error('phone')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-200">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    @error('date_of_birth')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-200">Address</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('address', $profile->address) }}</textarea>
                    @error('address')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-white mb-4">Emergency Contact</h3>
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="emergency_contact_name" class="block text-sm font-medium text-gray-200">Contact Name</label>
                    <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $profile->emergency_contact_name) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    @error('emergency_contact_name')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-200">Contact Phone</label>
                    <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    @error('emergency_contact_phone')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Bio -->
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-white mb-4">About Me</h3>
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-200">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Tell us about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                @error('bio')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                <p class="mt-2 text-sm text-gray-400">Brief description about yourself. Maximum 1000 characters.</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-6 border-t border-white/10">
            <a href="{{ route('student.profile.show') }}" class="text-sm text-gray-300 hover:text-white">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                Save Changes
            </button>
        </div>
    </form>

    <script>
        function removeAvatar() {
            if (confirm('Are you sure you want to remove your profile picture?')) {
                fetch('{{ route("student.profile.avatar.destroy") }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to remove avatar.');
                });
            }
        }
    </script>
</x-layout>