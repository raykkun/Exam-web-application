<x-layout title="Edit User">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">Edit User</h2>
        <p class="text-sm text-gray-400">Update the user's profile and account settings.</p>
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

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6 rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
        @csrf
        @method('PUT')

        @include('admin.users.form', ['user' => $user])
    </form>
</x-layout>
