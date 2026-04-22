<x-layout title="Exam Result">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-white">{{ $result->exam->title }} - Results</h2>
        <p class="text-sm text-gray-400">Detailed breakdown of your exam performance.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3 mb-8">
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <div class="text-center">
                <p class="text-3xl font-bold text-white">{{ number_format($result->score, 1) }}%</p>
                <p class="text-sm text-gray-400">Final Score</p>
            </div>
        </div>
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <div class="text-center">
                <p class="text-3xl font-bold text-indigo-400">{{ $result->grade_letter }}</p>
                <p class="text-sm text-gray-400">Grade</p>
            </div>
        </div>
        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
            <div class="text-center">
                <p class="text-3xl font-bold text-green-400">{{ number_format($result->grade_point, 1) }}</p>
                <p class="text-sm text-gray-400">Grade Point</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-white mb-4">Question Review</h3>
        <div class="space-y-4">
            @php
                $totalQuestions = $result->exam->questions->count();
                $correctAnswers = 0;
            @endphp

            @foreach($result->exam->questions as $index => $question)
                @php
                    $userAnswer = $result->answers[$question->id] ?? null;
                    $isCorrect = $userAnswer === $question->correct_answer;
                    if ($isCorrect) $correctAnswers++;
                @endphp

                <div class="border border-white/5 rounded-lg p-4 {{ $isCorrect ? 'bg-green-900/20' : 'bg-red-900/20' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-white">Question {{ $index + 1 }}</h4>
                            <p class="mt-2 text-sm text-gray-200">{{ $question->question_text }}</p>

                            <div class="mt-3 grid gap-2 text-sm">
                                <div class="flex items-center {{ $userAnswer === 'A' ? ($isCorrect ? 'text-green-400' : 'text-red-400') : 'text-gray-400' }}">
                                    <span class="font-medium mr-2">A.</span>
                                    <span>{{ $question->option_a }}</span>
                                    @if($userAnswer === 'A')<span class="ml-2">(Your answer)</span>@endif
                                    @if($question->correct_answer === 'A')<span class="ml-2 text-green-400">✓ Correct</span>@endif
                                </div>
                                <div class="flex items-center {{ $userAnswer === 'B' ? ($isCorrect ? 'text-green-400' : 'text-red-400') : 'text-gray-400' }}">
                                    <span class="font-medium mr-2">B.</span>
                                    <span>{{ $question->option_b }}</span>
                                    @if($userAnswer === 'B')<span class="ml-2">(Your answer)</span>@endif
                                    @if($question->correct_answer === 'B')<span class="ml-2 text-green-400">✓ Correct</span>@endif
                                </div>
                                <div class="flex items-center {{ $userAnswer === 'C' ? ($isCorrect ? 'text-green-400' : 'text-red-400') : 'text-gray-400' }}">
                                    <span class="font-medium mr-2">C.</span>
                                    <span>{{ $question->option_c }}</span>
                                    @if($userAnswer === 'C')<span class="ml-2">(Your answer)</span>@endif
                                    @if($question->correct_answer === 'C')<span class="ml-2 text-green-400">✓ Correct</span>@endif
                                </div>
                                <div class="flex items-center {{ $userAnswer === 'D' ? ($isCorrect ? 'text-green-400' : 'text-red-400') : 'text-gray-400' }}">
                                    <span class="font-medium mr-2">D.</span>
                                    <span>{{ $question->option_d }}</span>
                                    @if($userAnswer === 'D')<span class="ml-2">(Your answer)</span>@endif
                                    @if($question->correct_answer === 'D')<span class="ml-2 text-green-400">✓ Correct</span>@endif
                                </div>
                            </div>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            @if($isCorrect)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Correct</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Incorrect</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 pt-4 border-t border-white/10">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-400">Summary:</span>
                <span class="text-white">{{ $correctAnswers }} out of {{ $totalQuestions }} correct</span>
            </div>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('student.results') }}" class="rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-600">
            Back to Results
        </a>
        <a href="{{ route('student.exams') }}" class="rounded-md border border-white/10 bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
            Take Another Exam
        </a>
    </div>
</x-layout>