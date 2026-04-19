<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =['title' => 'Manage Subjects'];
        $subjects = Subject::latest()->paginate(10);
        
        return view('subjects.index', compact('subjects', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects,code',
            'description' => 'nullable',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects,code,' . $subject->id,
            'description' => 'nullable',
        ]);
        $subject->update($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
