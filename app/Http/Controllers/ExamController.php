<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\Classroom;
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
    return redirect()->route('teacher.exams.index');


    }

    /**
     * Display the specified resource.
     */

    // public function show ($id){
    //     $exam = Exam::with(['subject', 'classroom', 'creator'])->findOrFail($id);
    //     return view('teacher.exams.show', compact('exam'));
    // }

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

        return redirect()->route('teacher.exams.show', $exam)->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('teacher.exams.index')->with('success', 'Exam deleted successfully.');
    }

    
}
