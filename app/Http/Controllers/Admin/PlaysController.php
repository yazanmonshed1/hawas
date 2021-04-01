<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Play;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class PlaysController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'plays';
    }

    public function postSave($play, $data)
    {
        $media = json_decode($data['media']);
        $play->media()->sync($media);
        return $play;
    }

    public function postUpdate($play, $data)
    {
        $media = json_decode($data['media']);
        $play->media()->sync($media);
        return $play;
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
            'routeSlug' => 'plays',
            'data' => [
                'modelName' => 'Play',
                'searchCol' => 'title',
                'relationships' => [
                    'images' => 'media'
                ]
            ],
            'columns' => ['image', 'title', 'header_image', 'images', 'description', 'slug'],
            'id' => 'plays-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.plays.update',
                'store_action' => 'admin.plays.store',
            ]
        ];
        $grid = Play::renderGrid($dataTableRequest);
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
        $action = route('admin.plays.store');
        $form = Play::createForm($fb);
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
        $form = Play::createForm($fb);
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
        $form = Play::editForm($fb, ['id' => $id]);
        $model = Play::findOrFail($id);
        $action = route('admin.plays.update', [$model->id]);
        return view('admin.dashboard.general.add-edit')->with([
            'form' => $form->render($action, $model),
            'nameSlug' => $this->nameSlug
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
        $form = Play::editForm($fb, ['id' => $id]);
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
