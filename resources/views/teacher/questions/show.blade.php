<x-layout :title="'Question Details'">
    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="bg-white p-5 rounded shadow-sm">
            <h1 class="text-2xl font-bold mb-4">Question Details</h1>
            <p class="mb-4"><strong>Exam ID:</strong> {{ $question->exam_id }}</p>
            <p class="mb-4"><strong>Question:</strong> {{ $question->question_text }}</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div><strong>A</strong>: {{ $question->option_a }}</div>
                <div><strong>B</strong>: {{ $question->option_b }}</div>
                <div><strong>C</strong>: {{ $question->option_c }}</div>
                <div><strong>D</strong>: {{ $question->option_d }}</div>
            </div>
            <p class="mb-2"><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
            <p class="mb-4"><strong>Score:</strong> {{ $question->score }}</p>
            <a href="{{ route('teacher.my-exams.show', $question->exam_id) }}" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300">Back to exam</a>
        </div>
    </div>
</x-layout>
