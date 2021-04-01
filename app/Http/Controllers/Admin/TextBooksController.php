<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\TextBook;
use App\NadConsole\Services\FormBuilder;
use App\Models\TextBookPart;
use Illuminate\Http\Request;
use App\Models\ModelForms\TextBookForms;
use Illuminate\Support\Facades\Validator;

class TextBooksController extends NadsoftBaseCotroller
{

    public function __construct()
    {
        $this->nameSlug = 'text_books';
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
            'routeSlug' => 'text-books',
            'data' => [
                'modelName' => 'TextBook',
                'searchCol' => 'title',
            ],
            'columns' => ['front_cover', 'back_cover', 'title', 'description', 'slug'],
            'id' => 'blogs-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.text-books.update',
                'store_action' => 'admin.text-books.store',
            ],
            'additional_actions' => [
                'build_grid' => [
                    'label' => __('Build book'),
                    'classes' => 'btn btn-primary build-action'
                ]
            ],
            'additional_script' => 'text_book'
        ];
        $grid = TextBook::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
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
    public function create(FormBuilder $fb)
    {
        $action = route('admin.text-books.store');
        $form = TextBook::createForm($fb);
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
        $form = TextBook::createForm($fb);
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
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $fb, $id)
    {
        $form = TextBook::editForm($fb, ['id' => $id]);
        $model = TextBook::findOrFail($id);
        $action = route('admin.text-books.update', [$model->id]);
        return view('admin.text-books.edit')->with([
            'form' => $form->render($action, $model),
            'book' => $model
        ]);
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
        $form = TextBook::editForm($fb, ['id' => $id]);
        return parent::update($request, $form, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addBookPart(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'title' => $request->title,
            'text_book_id' => $id
        ];
        $part = TextBookPart::firstOrNew($data);
        if (!$part->exists) {
            $part->fill($data)->save();
        }
        return response()->json([
            'html' => view('admin.text-books.components.parts')->with('book', TextBook::find($id))->render(),
        ]);
    }
}
