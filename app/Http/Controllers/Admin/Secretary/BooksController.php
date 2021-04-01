<?php

namespace App\Http\Controllers\Admin\Secretary;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Secretary\Book;

class BooksController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'digital_books';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'data' => [
                'modelName' => 'Secretary.Book',
                'searchCol' => 'name',
            ],
            'columns' => ['cover_image', 'title', 'description'],
            'id' => 'schools-datatable'
        ];
        $grid = Book::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }
}
