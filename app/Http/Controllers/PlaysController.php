<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\NadConsole\Helper;
use Meta;
use Illuminate\Http\Request;

class PlaysController extends Controller
{
    public function index()
    {
        Meta::title('الحواس - المسرحيات');
        Meta::set('image', asset('storage/' . Helper::setting('meta.plays_og_image')));
        $plays = Play::where('type', 'play')->get();
        return view('plays.index')->with(['plays' => $plays]);
    }

    public function show(Request $request, $slug)
    {
        $play = Play::where(['slug' => $slug, 'type' => 'play'])->firstOrFail();
        Meta::title($play->title);
        Meta::set('description', asset('storage/' . $play->description));
        Meta::set('image', asset('storage/' . $play->header_image));
        return view('plays.show')->with('play', $play);
    }
}
