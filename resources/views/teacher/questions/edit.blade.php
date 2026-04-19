<x-layout :title="'Edit Question'">
    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 mb-4 p-5">
            <div class="col-span-6 mt-2">
                <h1 class="text-3xl font-bold">Edit Question</h1>
                <p class="text-gray-600 mt-2">Update the question details.</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow-sm">
            <form action="{{ route('teacher.questions.update', $question) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="question_text">Question</label>
                    <textarea name="question_text" rows="4" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>{{ old('question_text', $question->question_text) }}</textarea>
                    @error('question_text')
                    <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-5">
                        <label for="option_a">Option A</label>
                        <input type="text" name="option_a" value="{{ old('option_a', $question->option_a) }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_a')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_b">Option B</label>
                        <input type="text" name="option_b" value="{{ old('option_b', $question->option_b) }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_b')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_c">Option C</label>
                        <input type="text" name="option_c" value="{{ old('option_c', $question->option_c) }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_c')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_d">Option D</label>
                        <input type="text" name="option_d" value="{{ old('option_d', $question->option_d) }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_d')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-5">
                        <label for="correct_answer">Correct Answer</label>
                        <select name="correct_answer" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                            <option value="">Select correct answer</option>
                            <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('correct_answer')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="score">Score</label>
                        <input type="number" name="score" value="{{ old('score', $question->score) }}" min="1" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('score')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-full hover:bg-blue-700">Update Question</button>
                    <a href="{{ route('teacher.exams.show', $question->exam_id) }}" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
