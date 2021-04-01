<?php

namespace App\Http\Controllers;

use App\Models\YoutubeVideo;
use Meta;
use Helper;

class ChannelController extends Controller
{
    public function index()
    {
        Meta::title('قناة الحواس');
        Meta::set('image', asset('storage/' . Helper::setting('meta.channel_og_image')));
        
        $videos = YoutubeVideo::where('show', true)->get();
        return view('channel.index')->with(['videos' => $videos]);
    }

}
