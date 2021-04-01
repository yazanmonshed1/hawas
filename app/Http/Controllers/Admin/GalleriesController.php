<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class GalleriesController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->name = ['singular' => __('معرض'), 'plural' => __('معارض')];
        $this->nameSlug = 'galleries';
    }

    public function postSave($gallery, $data)
    {
        $media = json_decode($data['media']);
        $gallery->media()->sync($media);
        return $gallery;
    }

    public function postUpdate($gallery, $data)
    {
        $media = json_decode($data['media']);
        $gallery->media()->sync($media);
        return $gallery;
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
            'routeSlug' => 'galleries',
            'data' => [
                'relationships' => [
                    'images' => 'media'
                ],
                'modelName' => 'Gallery',
                'searchCol' => 'id',
            ],
            'columns' => ['images'],
            'id' => 'galleries-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.galleries.update',
                'store_action' => 'admin.galleries.store',
            ]
        ];
        $grid = Gallery::renderGrid($dataTableRequest);
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
        $form = Gallery::createForm($fb);
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
        $form = Gallery::createForm($fb);
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
}
