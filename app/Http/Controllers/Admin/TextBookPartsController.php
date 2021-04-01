<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\TextBook;
use App\Models\TextBookPart;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class TextBookPartsController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'text_book_parts';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTableRequest = [
            'processing' => true,
            'serverSide' => true,
            'nameSlug' => $this->nameSlug,
            'ajax' => [
                'url' => route('admin.get-data.datatable'),
                'data' => [
                    'modelName' => 'TextBookPart',
                    'searchCol' => 'title',
                ]
            ],
            'columns' => ['title'],
            'id' => 'text-book-parts-datatable',
            'popup' => true,
            'form_options' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.text-book-parts.update',
                'store_action' => 'admin.text-book-parts.store',
            ]
        ];
        $grid = TextBookPart::renderGrid($dataTableRequest, 'text-book-parts');
        return view('admin.general.index')->with([
            'routeSlug' => 'text-book-parts',
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, FormBuilder $fb)
    {
        $action = route('admin.text-book-parts.store');
        $form = TextBookPart::createForBookForm($fb, $request->bookId);
        return view('admin.dashboard.general.add-edit')->with([
            'form' => $form->render($action),
            'nameSlug' => $this->nameSlug
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $fb)
    {
        $form = TextBookPart::createForm($fb);
        return parent::store($request, $form);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $fb, $id)
    {
        $form = TextBookPart::createForm($fb, ['text_book_id' => $request->text_book_id]);
        parent::update($request, $form, $id);
        return response()->json([
            'html' => view('admin.text-books.components.parts')->with('book', TextBook::find($request->text_book_id))->render(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = TextBookPart::find($id);
        $part->delete();
        return response()->json([
            'html' => view('admin.text-books.components.parts')->with('book', $part->book)->render(),
        ]);
    }
}
