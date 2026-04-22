<x-layout title="Exam Details">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">{{ $exam->title }}</h2>
        <p class="text-sm text-gray-400">Review exam details before starting.</p>
    </div>

    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
        <dl class="grid gap-6 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-400">Subject</dt>
                <dd class="mt-1 text-white">{{ $exam->subject->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-400">Classroom</dt>
                <dd class="mt-1 text-white">{{ $exam->classroom->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-400">Duration</dt>
                <dd class="mt-1 text-white">{{ $exam->duration }} minutes</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-400">Questions</dt>
                <dd class="mt-1 text-white">{{ $exam->questions->count() }} questions</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-400">Start Time</dt>
                <dd class="mt-1 text-white">{{ $exam->start_at->format('d M Y H:i') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-400">End Time</dt>
                <dd class="mt-1 text-white">{{ $exam->ends_at->format('d M Y H:i') }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('student.exam.start', $exam) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                Start Exam
            </a>
            <a href="{{ route('student.exams') }}" class="rounded-md border border-white/10 bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                Back to Exams
            </a>
        </div>
    </div>
</x-layout>