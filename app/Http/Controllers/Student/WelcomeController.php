<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $booksGrouped = auth()->user()->grade->books->chunk(4);
        return view('student.index')->with(compact('booksGrouped'));
    }
}
