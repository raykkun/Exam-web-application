<x-layout :title="'Exam Detail - ' . $exam->title">
    <div class="space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Exam detail</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900">{{ $exam->title }}</h1>
                    <p class="mt-2 text-sm text-slate-600">A quick view of the exam metadata and associated questions.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('teacher.questions.create', ['exam_id' => $exam->id]) }}"
                       class="inline-flex items-center justify-center rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Add Question
                    </a>
                    <a href="{{ route('teacher.exams.index') }}"
                       class="inline-flex items-center justify-center rounded-full bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                        Back to exams
                    </a>
                </div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2">
                <div class="rounded-3xl bg-slate-50 p-5">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Exam information</h2>
                    <dl class="mt-4 space-y-4 text-sm text-slate-700">
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Subject</dt>
                            <dd class="text-right text-slate-600">{{ $exam->subject->name ?? 'Unassigned' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Classroom</dt>
                            <dd class="text-right text-slate-600">{{ $exam->classroom->name ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Creator</dt>
                            <dd class="text-right text-slate-600">{{ $exam->creator->name ?? 'Unknown' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Start at</dt>
                            <dd class="text-right text-slate-600">{{ $exam->start_at ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Ends at</dt>
                            <dd class="text-right text-slate-600">{{ $exam->ends_at ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Duration</dt>
                            <dd class="text-right text-slate-600">{{ $exam->duration ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="font-medium text-slate-900">Status</dt>
                            <dd class="rounded-full bg-emerald-100 px-3 py-1 text-emerald-700">{{ $exam->status ?? 'Draft' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl bg-slate-50 p-5">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Quick summary</h2>
                    <div class="mt-4 space-y-4 text-sm text-slate-700">
                        <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                            <p class="text-slate-500">Total questions</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $exam->questions->count() }}</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                            <p class="text-slate-500">Total score</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $exam->questions->sum('score') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Questions</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Exam question list</h2>
                    <p class="mt-2 text-sm text-slate-600">Review question options, scores, and the correct answer for each item.</p>
                </div>
                <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">{{ $exam->questions->count() }} items</span>
            </div>

            <div class="mt-6 space-y-4">
                @forelse($exam->questions as $question)
                    <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Question {{ $loop->iteration }}</p>
                                <p class="mt-3 text-base font-medium text-slate-900">{{ $question->question_text }}</p>
                            </div>
                            <div class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-200">Score: {{ $question->score }}</div>
                        </div>

                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl bg-white p-4 ring-1 ring-slate-200">
                                <span class="text-sm font-semibold text-slate-700">A</span>
                                <p class="mt-2 text-slate-600">{{ $question->option_a }}</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 ring-1 ring-slate-200">
                                <span class="text-sm font-semibold text-slate-700">B</span>
                                <p class="mt-2 text-slate-600">{{ $question->option_b }}</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 ring-1 ring-slate-200">
                                <span class="text-sm font-semibold text-slate-700">C</span>
                                <p class="mt-2 text-slate-600">{{ $question->option_c }}</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 ring-1 ring-slate-200">
                                <span class="text-sm font-semibold text-slate-700">D</span>
                                <p class="mt-2 text-slate-600">{{ $question->option_d }}</p>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-col gap-2 rounded-2xl bg-white p-4 text-sm text-slate-700 ring-1 ring-slate-200 md:flex-row md:items-center md:justify-between">
                            <span class="font-semibold text-slate-900">Correct answer:</span>
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-emerald-700">{{ strtoupper($question->correct_answer) }}</span>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-600">
                        There are no questions for this exam yet.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-layout>
