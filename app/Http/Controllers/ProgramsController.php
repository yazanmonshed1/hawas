<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Meta;
use Helper;

class ProgramsController extends Controller
{
    public function index()
    {
        Meta::title('البرامج');
        Meta::set('image', asset('storage/' . Helper::setting('meta.programs_og_image')));
        $programs = Program::all();
        return view('programs.index')->with(['programs' => $programs]);
    }

    public function show(Request $request, $slug)
    {
        $program = Program::where(['slug' => $slug])->firstOrFail();
        Meta::title('البرامج - ' . $program->name);
        Meta::set('image', asset('storage/' . $program->image));
        Meta::set('description', asset('storage/' . $program->description));
        return view('programs.show')->with('program', $program);
    }
}
