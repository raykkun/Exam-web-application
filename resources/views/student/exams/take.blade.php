<x-layout title="Taking Exam: {{ $exam->title }}">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-white">{{ $exam->title }}</h2>
                <p class="text-sm text-gray-400">Answer all questions. You have {{ $exam->duration }} minutes.</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-400">Time remaining</p>
                <p id="timer" class="text-lg font-semibold text-white">00:00:00</p>
            </div>
        </div>
    </div>

    <form id="examForm" method="POST" action="{{ route('student.exam.submit', $exam) }}">
        @csrf
        <div class="space-y-6">
            @foreach($exam->questions as $index => $question)
                <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-6 shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-white">Question {{ $index + 1 }}</h3>
                        <p class="mt-2 text-gray-200">{{ $question->question_text }}</p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="radio" name="answers[{{ $question->id }}]" value="A" id="q{{ $question->id }}a" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900">
                            <label for="q{{ $question->id }}a" class="ml-3 text-sm text-gray-200">
                                <span class="font-medium">A.</span> {{ $question->option_a }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="answers[{{ $question->id }}]" value="B" id="q{{ $question->id }}b" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900">
                            <label for="q{{ $question->id }}b" class="ml-3 text-sm text-gray-200">
                                <span class="font-medium">B.</span> {{ $question->option_b }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="answers[{{ $question->id }}]" value="C" id="q{{ $question->id }}c" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900">
                            <label for="q{{ $question->id }}c" class="ml-3 text-sm text-gray-200">
                                <span class="font-medium">C.</span> {{ $question->option_c }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="answers[{{ $question->id }}]" value="D" id="q{{ $question->id }}d" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900">
                            <label for="q{{ $question->id }}d" class="ml-3 text-sm text-gray-200">
                                <span class="font-medium">D.</span> {{ $question->option_d }}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex items-center justify-between">
            <p class="text-sm text-gray-400">Make sure to answer all questions before submitting.</p>
            <button type="submit" id="submitBtn" class="rounded-md bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                Submit Exam
            </button>
        </div>
    </form>

    <script>
        // Timer functionality
        const duration = {{ $exam->duration }} * 60; // Convert to seconds
        let timeLeft = duration;
        const timerElement = document.getElementById('timer');
        const submitBtn = document.getElementById('submitBtn');
        const examForm = document.getElementById('examForm');

        function updateTimer() {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;

            timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft <= 0) {
                examForm.submit();
            } else {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            }
        }

        // Warn user before leaving page
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = 'Are you sure you want to leave? Your progress will be lost.';
        });

        // Remove warning on form submit
        examForm.addEventListener('submit', function() {
            window.removeEventListener('beforeunload', arguments.callee);
        });

        updateTimer();
    </script>
</x-layout>