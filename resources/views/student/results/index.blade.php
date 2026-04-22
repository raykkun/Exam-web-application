<x-layout title="My Results">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Exam Results</h2>
            <p class="text-sm text-gray-400">View your completed exam results and scores.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-700 bg-green-900/80 p-4 text-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($results as $result)
            <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">{{ $result->exam->title }}</h3>
                        <p class="mt-1 text-sm text-gray-400">{{ $result->exam->subject->name }}</p>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-white">{{ number_format($result->score, 1) }}%</p>
                                <p class="text-xs text-gray-400">Score</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-indigo-400">{{ $result->grade_letter }}</p>
                                <p class="text-xs text-gray-400">Grade</p>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-300">Completed: {{ $result->submitted_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('student.result.show', $result) }}" class="w-full flex items-center justify-center rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-600">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-white/10 bg-slate-950/40 p-12 shadow-sm text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-white">No results yet</h3>
                <p class="mt-2 text-sm text-gray-400">Complete some exams to see your results here.</p>
            </div>
        @endforelse
    </div>
</x-layout>