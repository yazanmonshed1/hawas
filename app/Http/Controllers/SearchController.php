<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\DigitalBook;
use App\Models\Play;
use App\Models\TextBook;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchString = $request->search;

        $textBooks = collect([]);
        $digitalBooks = collect([]);
        $blogs = collect([]);
        $plays = collect([]);
        if ($searchString) {
            $textBooks = TextBook::where('title', 'like', "%$searchString%")->orWhere('description', 'like', "%$searchString%")->get();
            $digitalBooks = DigitalBook::where('title', 'like', "%$searchString%")->orWhere('description', 'like', "%$searchString%")->get();
            $blogs = Blog::where('title', 'like', "%$searchString%")->orWhere('body', 'like', "%$searchString%")->get();
            $plays = Play::where('title', 'like', "%$searchString%")->orWhere('description', 'like', "%$searchString%")->get();
        }

        return view('search.index')->with(compact('textBooks', 'digitalBooks', 'blogs', 'plays'));
    }
}
