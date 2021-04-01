<?php

namespace App\Http\Controllers;

use App\Models\Collapse;
use App\Models\Blog;
use App\Models\Program;
use App\Models\Slider;
use App\NadConsole\Models\Media;
use App\NadConsole\Models\Setting;
use Meta;
use Helper;

class HomeController extends Controller
{
    public function index()
    {
        Meta::set('image', asset('storage/' . Helper::setting('meta.home_og_image')));
        $sliders = Slider::orderBy('id', 'DESC')->limit(3)->get();
        $blogs = Blog::orderBy('id', 'DESC')->limit(6)->get();
        $programs = Program::orderBy('id', 'DESC')->limit(2)->get();
        return view('index')->with(compact('sliders', 'blogs', 'programs'));
    }

    public function about()
    {
        $collapses = Collapse::where('text_book_part_id', null)->get();
        $gellry_ids = json_decode(Setting::where('name', 'site.about_us_gallery')->first()->value);
        $gallery = Media::find($gellry_ids);

        Meta::title('الحواس - عنا');
        Meta::set('image', asset('storage/' . Helper::setting('site.about_us_page_image')));

        return view('about.index')->with(compact('collapses', 'gallery'));
    }
}
