<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    # in below, add this method to handle test results with semesters, and from me
    public function index() {
    // Assuming you have a 'grades' relationship that includes 'subject'
    $semesters = Auth::user()->grades()
        ->with('subject')
        ->get()
        ->groupBy('semester_name');

    return view('transcript.index', compact('semesters'));
}
}
