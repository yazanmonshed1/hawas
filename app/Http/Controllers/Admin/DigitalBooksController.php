<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\DigitalBook;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class DigitalBooksController extends NadsoftBaseCotroller
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
            'routeSlug' => 'digital-books',
            'data' => [
                'modelName' => 'DigitalBook',
                'searchCol' => 'title'
            ],
            'columns' => ['intro', 'cover_image', 'title', 'description', 'slug'],
            'id' => 'blogs-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.digital-books.update',
                'store_action' => 'admin.digital-books.store',
            ],
            'additional_actions' => [
                'build_grid' => [
                    'label' => __('Build book'),
                    'classes' => 'btn btn-primary build-action'
                ]
            ],
            'additional_script' => 'digital_book'
        ];
        $grid = DigitalBook::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $form = DigitalBook::createForm($fb);
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
        $form = DigitalBook::editForm($fb);
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

    public function postSave($model, $data)
    {
        $extension = substr(strrchr($model->intro, '.'), 1);
        $mediaType = in_array($extension, ['mp4', 'wmv', 'avi']) ? 'video' : 'image';
        $model->media_type = $mediaType;
        $model->save();
        return $model;
    }

    public function postUpdate($model, $data)
    {
        $extension = substr(strrchr($model->intro, '.'), 1);
        $mediaType = in_array($extension, ['mp4', 'wmv', 'avi']) ? 'video' : 'image';
        $model->media_type = $mediaType;
        $model->save();
        return $model;
    }
}
