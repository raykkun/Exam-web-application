<x-layout title="Create User">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">Create User</h2>
        <p class="text-sm text-gray-400">Add a new user account and assign a role.</p>
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

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6 rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
        @csrf
        @include('admin.users.form')
    </form>
</x-layout>
