<?php

namespace App\Http\Controllers;

use App\Models\DigitalBook;
use App\Models\TextBook;
use Illuminate\Http\Request;
use Meta;
use Helper;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LibraryController extends Controller
{
    public function index($type)
    {
        if (!in_array($type, ['text', 'digital'])) {
            throw new NotFoundHttpException();
        }
        Meta::title('المكتبة');
        Meta::set('image', Helper::setting('meta.library_og_image'));
        $textBooks = TextBook::orderBy('id', 'DESC')->get();
        $digitalBooks = DigitalBook::orderBy('id', 'DESC')->get();
        return view('library.index')->with(compact('textBooks', 'digitalBooks', 'type'));
    }

    // public function digitalBook(Request $request, $slug)
    // {
    //     $book = digitalBook::where(['slug' => $slug])->firstOrFail();

    //     Meta::title('المكتبة - ' . $book->title);
    //     Meta::set('image', asset('storage/' . $book->intro));
    //     Meta::set('description', asset('storage/' . $book->description));

    //     return view('library.digital_book.index')->with('book', $book);
    // }

    public function textBook(Request $request, $slug)
    {
        $book = TextBook::where(['slug' => $slug])->firstOrFail();

        Meta::title('المكتبة - ' . $book->title);
        Meta::set('image', asset('storage/' . $book->front_cover));
        Meta::set('description', asset('storage/' . $book->description));

        return view('library.text_book.index')->with('book', $book);
    }
}
