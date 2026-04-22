<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Result;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ['title' => 'My Exams',
                'name' => auth()->user()->name 
                ];// Ambil nama asli dari DB]
        $exams = Exam::with(['subject', 'classroom', 'creator'])
                ->latest()
                ->paginate(10);

        return view('teacher.exams.index',compact('exams'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $classrooms = Classroom::orderBy('name')->get();
        $creator_id = auth()->id(); // Take ID User on logged in


        return view('teacher.exams.create', compact('subjects', 'classrooms', 'creator_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
    {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'subject_id' => 'required|exists:subjects,id',
        'classroom_id' => 'required|exists:classrooms,id', 
        'creator_id' => 'required|exists:users,id',
        'start_at' => 'required|date',
        'ends_at' => 'required|date|after:start_at',
        'duration' => 'required|integer|min:1',
        'status' => 'required|in:draft,scheduled,running,finished',  // ✅ add this
    ]);

    Exam::create($data);
    return redirect()->route('teacher.exams.index')->with('success', 'Exam created successfully.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Exam $exam)
    {
        // $exam->load(['questions', 'subject', 'classroom', 'creat or']);
        
        $exam->load(['subject', 'classroom', 'creator']);
        // dd($exam);
        return view('teacher.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $subjects = Subject::orderBy('name')->get();
        $classrooms = Classroom::orderBy('name')->get();

        return view('teacher.exams.edit', compact('exam', 'subjects', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'start_at' => 'required|date',
            'ends_at' => 'required|date|after:start_at',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:draft,scheduled,running,finished',
        ]);

        $exam->update($data);

        return redirect()->route('teacher.exams.index', $exam)->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('teacher.exams.index')->with('success', 'Exam deleted successfully.');
    }


    // Student methods
    public function myExams()
    {
        $user = auth()->user();
        $classroomId = $user->classroom?->id;

        // Check if student has classroom assigned
        if (!$classroomId) {
            return view('student.exams.index', [
                'exams' => collect(),
                'error' => 'You are not assigned to any classroom. Please contact your administrator.'
            ]);
        }

        // Get exams for student's classroom that are scheduled or running
        $exams = Exam::where('classroom_id', $classroomId)
            ->whereIn('status', ['scheduled', 'running'])
            ->where('start_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->with(['subject', 'creator'])
            ->get();

        return view('student.exams.index', compact('exams'));
    }

    public function showExam(Exam $exam)
    {
        // Check if student can access this exam
        $user = auth()->user();
        $classroomId = $user->classroom?->id;
        
        if (!$classroomId || $exam->classroom_id !== $classroomId) {
            abort(403, 'You are not authorized to view this exam.');
        }

        $exam->load(['subject', 'classroom', 'creator']);
        return view('student.exams.show', compact('exam'));
    }

    public function startExam(Exam $exam)
    {
        $user = auth()->user();
        $classroomId = $user->classroom?->id;
        
        // Check if student can access this exam
        if (!$classroomId || $exam->classroom_id !== $classroomId) {
            abort(403, 'You are not authorized to take this exam.');
        }

        // Check if exam is available
        if ($exam->status !== 'running' || now()->lt($exam->start_at) || now()->gt($exam->ends_at)) {
            return redirect()->route('student.exams')->with('error', 'Exam is not available at this time.');
        }

        // Check if student already took the exam
        $existingResult = Result::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->first();

        if ($existingResult && $existingResult->submitted_at) {
            return redirect()->route('student.results')->with('error', 'You have already completed this exam.');
        }

        $exam->load('questions');

        // If no existing result, create one
        if (!$existingResult) {
            $result = Result::create([
                'user_id' => $user->id,
                'exam_id' => $exam->id,
                'answers' => [],
                'score' => 0,
                'grade_letter' => '',
                'grade_point' => 0,
                'started_at' => now(),
            ]);
        } else {
            $result = $existingResult;
        }

        return view('student.exams.take', compact('exam', 'result'));
    }

    public function submitExam(Request $request, Exam $exam)
    {
        $user = auth()->user();
        $classroomId = $user->classroom?->id;
        
        // Check if student can access this exam
        if (!$classroomId || $exam->classroom_id !== $classroomId) {
            abort(403, 'You are not authorized to submit this exam.');
        }

        $result = Result::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        // Prevent resubmission
        if ($result->submitted_at) {
            return redirect()->route('student.results')->with('error', 'Exam already submitted.');
        }

        $answers = $request->input('answers', []);
        $exam->load('questions');

        $totalScore = 0;
        $maxScore = $exam->questions->sum('score');

        foreach ($exam->questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer === $question->correct_answer) {
                $totalScore += $question->score;
            }
        }

        $percentage = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;

        // Calculate grade
        $gradeLetter = $this->calculateGrade($percentage);
        $gradePoint = $this->calculateGradePoint($percentage);

        $result->update([
            'answers' => $answers,
            'score' => $percentage,
            'grade_letter' => $gradeLetter,
            'grade_point' => $gradePoint,
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.result.show', $result)->with('success', 'Exam submitted successfully!');
    }

    public function myResults()
    {
        $user = auth()->user();
        $results = Result::where('user_id', $user->id)
            ->with('exam.subject')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('student.results.index', compact('results'));
    }

    public function showResult(Result $result)
    {
        // Check ownership
        if ($result->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to view this result.');
        }

        $result->load(['exam.questions', 'exam.subject']);
        return view('student.results.show', compact('result'));
    }

    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A';
        if ($percentage >= 80) return 'B';
        if ($percentage >= 70) return 'C';
        if ($percentage >= 60) return 'D';
        return 'E';
    }

    private function calculateGradePoint($percentage)
    {
        if ($percentage >= 90) return 4.0;
        if ($percentage >= 80) return 3.0;
        if ($percentage >= 70) return 2.0;
        if ($percentage >= 60) return 1.0;
        return 0.0;
    }
}
