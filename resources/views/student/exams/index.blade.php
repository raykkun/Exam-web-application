<x-layout title="My Exams">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Available Exams</h2>
            <p class="text-sm text-gray-400">Take your scheduled exams from this list.</p>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-700 bg-red-900/80 p-4 text-red-100">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($error))
        <div class="mb-6 rounded-lg border border-red-700 bg-red-900/80 p-4 text-red-100">
            {{ $error }}
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($exams as $exam)
            <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">{{ $exam->title }}</h3>
                        <p class="mt-1 text-sm text-gray-400">{{ $exam->subject->name }}</p>
                        <p class="mt-2 text-sm text-gray-300">Duration: {{ $exam->duration }} minutes</p>
                        <p class="text-sm text-gray-300">Ends: {{ $exam->ends_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('student.exam.show', $exam) }}" class="w-full flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-white/10 bg-slate-950/40 p-12 shadow-sm text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-white">No exams available</h3>
                <p class="mt-2 text-sm text-gray-400">There are no exams currently available for you to take.</p>
            </div>
        @endforelse
    </div>
</x-layout>