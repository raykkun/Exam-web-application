<x-layout title="User Profile">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-white">{{ $user->name }}</h2>
            <p class="text-sm text-gray-400">Profile details for this user account.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Edit</a>
            <a href="{{ route('admin.users.index') }}" class="rounded-md border border-white/10 bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Back</a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-400">Account information</h3>
            <dl class="mt-6 grid gap-5 text-sm leading-6 text-gray-200 sm:grid-cols-2">
                <div>
                    <dt class="font-medium text-gray-400">Name</dt>
                    <dd class="mt-1 text-white">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-400">Email</dt>
                    <dd class="mt-1 text-white">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-400">Role</dt>
                    <dd class="mt-1 text-white">{{ ucfirst($user->role) }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-400">Classroom</dt>
                    <dd class="mt-1 text-white">{{ $user->classroom ? $user->classroom->name : 'Not assigned' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-400">Joined</dt>
                    <dd class="mt-1 text-white">{{ $user->created_at->format('d M Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-400">Activity</h3>
            <div class="mt-6 space-y-4 text-sm text-gray-300">
                <p>Last updated: <span class="font-medium text-white">{{ $user->updated_at->diffForHumans() }}</span></p>
                <p>User ID: <span class="font-medium text-white">{{ $user->id }}</span></p>
                <p>Status: <span class="inline-flex rounded-full bg-green-700/20 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-green-200">Active</span></p>
            </div>
        </div>
    </div>
</x-layout>
