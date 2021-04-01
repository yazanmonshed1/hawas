<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Blog;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class BlogsController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'blogs';
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
            'routeSlug' => 'blogs',
            'data' => [
                'modelName' => 'Blog',
                'searchCol' => 'title',
            ],
            'columns' => ['image', 'title', 'brief', 'slug'],
            'id' => 'blogs-datatable',
        ];
        $grid = Blog::renderGrid($dataTableRequest);
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
        $action = route('admin.blogs.store');
        $form = Blog::createForm($fb);
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
        $form = Blog::createForm($fb);
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
        $model = Blog::findOrFail($id);
        $action = route('admin.blogs.update', [$model->id]);
        $form = Blog::editForm($fb, $id);
        $model = $form->model->findOrFail($id);
        return view('admin.dashboard.general.add-edit')->with([
            'form' => $form->render($action, $model),
            'nameSlug' => $this->nameSlug,
            'edit' => true
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
        $form = Blog::editForm($fb, $id);
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
