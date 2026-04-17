<x-layout :title="'Add Question'">
    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 mb-4 p-5">
            <div class="col-span-6 mt-2">
                <h1 class="text-3xl font-bold">Add Question</h1>
                <p class="text-gray-600 mt-2">Create a new question for this exam.</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow-sm">
            <form action="{{ route('teacher.questions.store') }}" method="POST">
                @csrf

                <input type="hidden" name="exam_id" value="{{ old('exam_id', $exam_id) }}">
                @error('exam_id')
                <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label for="question_text">Question</label>
                    <textarea name="question_text" rows="4" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>{{ old('question_text') }}</textarea>
                    @error('question_text')
                    <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-5">
                        <label for="option_a">Option A</label>
                        <input type="text" name="option_a" value="{{ old('option_a') }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_a')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_b">Option B</label>
                        <input type="text" name="option_b" value="{{ old('option_b') }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_b')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_c">Option C</label>
                        <input type="text" name="option_c" value="{{ old('option_c') }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('option_c')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="option_d">Option D</label>
                        <input type="text" name="option_d" value="{{ old('option_d') }}" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
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
                            <option value="A" {{ old('correct_answer') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('correct_answer') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('correct_answer') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('correct_answer') == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('correct_answer')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="score">Score</label>
                        <input type="number" name="score" value="{{ old('score') }}" min="1" class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        @error('score')
                        <div class="bg-red-400 p-2 rounded mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-full hover:bg-blue-700">Save Question</button>
                    <a href="{{ $exam_id ? route('teacher.exams.show', $exam_id) : route('teacher.exams.index') }}" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
