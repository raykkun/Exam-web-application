<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teacher.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $exam_id = $request->exam_id;
        
        return view('teacher.questions.create', compact('exam_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'score' => 'required|integer|min:1',
        ]);

        $data['created_by'] = auth()->id();
        

        Question::create($data);

        return redirect()->route('teacher.exams.show', $request->exam_id)->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('teacher.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('teacher.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'score' => 'required|integer|min:1',
        ]);

        $question->update($data);

        return redirect()->route('teacher.my-exams.show', $question->exam_id)->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $exam_id = $question->exam_id;
        $question->delete();

        return redirect()->route('teacher.my-exams.show', $exam_id)->with('success', 'Question deleted successfully.');
    }
}
