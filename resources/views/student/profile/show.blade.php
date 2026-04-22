<x-layout title="My Profile">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">My Profile</h2>
        <p class="text-sm text-gray-400">View and manage your personal information.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Profile Picture and Basic Info -->
        <div class="lg:col-span-1">
            <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                <div class="flex flex-col items-center">
                    <div class="relative">
                        @if($profile->avatar)
                            <img src="{{ asset('storage/avatars/' . $profile->avatar) }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover border-2 border-indigo-500">
                        @else
                            <div class="w-24 h-24 rounded-full bg-indigo-600 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-white">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-400">{{ ucfirst($user->role) }}</p>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>

                    <div class="mt-4 w-full">
                        <a href="{{ route('student.profile.edit') }}" class="w-full flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="lg:col-span-2">
            <div class="space-y-6">
                <!-- Personal Information -->
                <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-white mb-4">Personal Information</h3>
                    <dl class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Phone</dt>
                            <dd class="mt-1 text-white">{{ $profile->phone ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Date of Birth</dt>
                            <dd class="mt-1 text-white">{{ $profile->date_of_birth ? $profile->date_of_birth->format('d M Y') : 'Not provided' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-400">Address</dt>
                            <dd class="mt-1 text-white">{{ $profile->address ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Emergency Contact -->
                <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-white mb-4">Emergency Contact</h3>
                    <dl class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Contact Name</dt>
                            <dd class="mt-1 text-white">{{ $profile->emergency_contact_name ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Contact Phone</dt>
                            <dd class="mt-1 text-white">{{ $profile->emergency_contact_phone ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Bio -->
                @if($profile->bio)
                <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-white mb-4">About Me</h3>
                    <p class="text-gray-200">{{ $profile->bio }}</p>
                </div>
                @endif

                <!-- Statistics -->
                <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-white mb-4">Academic Statistics</h3>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-indigo-400">{{ $user->results()->whereNotNull('submitted_at')->count() }}</p>
                            <p class="text-sm text-gray-400">Exams Taken</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-400">{{ number_format($user->results()->whereNotNull('submitted_at')->avg('score') ?? 0, 1) }}%</p>
                            <p class="text-sm text-gray-400">Average Score</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-yellow-400">{{ $user->results()->whereNotNull('submitted_at')->where('grade_letter', 'A')->count() }}</p>
                            <p class="text-sm text-gray-400">A Grades</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>