<x-layout title="Manage Users">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Users</h2>
            <p class="text-sm text-gray-400">Manage all application users from the admin dashboard.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Create user</a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-700 bg-green-900/80 p-4 text-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-slate-950/40 shadow-sm">
        <table class="min-w-full divide-y divide-white/10 text-left text-sm text-gray-200">
            <thead class="bg-slate-900/80 text-xs uppercase tracking-wide text-gray-400">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Classroom</th>
                    <th class="px-4 py-3">Joined</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10 bg-slate-950/80">
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-4 font-medium text-white">{{ $user->name }}</td>
                        <td class="px-4 py-4 text-gray-300">{{ $user->email }}</td>
                        <td class="px-4 py-4 text-gray-300">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-4 text-gray-300">{{ $user->classroom ? $user->classroom->name : '-' }}</td>
                        <td class="px-4 py-4 text-gray-300">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-4 space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" class="rounded-md bg-slate-700 px-3 py-1 text-xs font-semibold text-white hover:bg-slate-600">Profile</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white hover:bg-indigo-500">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-500" onclick="return confirm('Delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">No users found. Create the first user to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
