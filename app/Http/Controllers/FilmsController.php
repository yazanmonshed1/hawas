<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\NadConsole\Helper;
use Illuminate\Http\Request;
use Meta;

class FilmsController extends Controller
{
    public function index()
    {
        Meta::title('الحواس - الافلام');
        Meta::set('image', asset('storage/' . Helper::setting('meta.films_og_image')));
        $films = Play::where('type', 'film')->get();
        return view('films.index')->with(['films' => $films]);
    }

    public function show(Request $request, $slug)
    {
        $film = Play::where(['slug' => $slug, 'type' => 'film'])->firstOrFail();
        Meta::title($film->title);
        Meta::set('description', asset('storage/' . $film->description));
        Meta::set('image', asset('storage/' . $film->header_image));
        return view('films.show')->with('film', $film);
    }
}
