<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Meta;
use Helper;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Meta::title('المدونة');
        Meta::set('image', Helper::setting('meta.blogs_og_image'));
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('blogs.index')->with('blogs', $blogs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where(['slug' => $slug])->firstOrFail();
        $blogs = Blog::orderBy('id', 'DESC')->where('id', '!=', $blog->id)->limit(4)->get();
        Meta::title('المدونة - ' . $blog->title);
        Meta::set('image', asset('storage/' . $blog->image));
        Meta::set('description', asset('storage/' . $blog->brief));
        return view('blogs.show')->with([
            'blog' => $blog,
            'blogs' => $blogs
        ]);
    }
}
