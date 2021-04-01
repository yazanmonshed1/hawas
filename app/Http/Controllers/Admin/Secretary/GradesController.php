<?php

namespace App\Http\Controllers\Admin\Secretary;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Grade;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class GradesController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'grades';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'routeSlug' => 'grades',
            'data' => [
                'modelName' => 'Grade',
                'searchCol' => 'name',
                'relationships' => [
                    'books' => 'books,title,multiple,<br>',
                    'teacher' => 'teacher,name'
                ]
            ],
            'columns' => ['name', 'books', 'teacher'],
            'id' => 'grades-datatable',
            'popup' => [
                'edit_form' => 'editFormForSchool',
                'create_form' => 'createFormForSchool',
                'update_action' => 'admin.secretary.grades.update',
                'store_action' => 'admin.secretary.grades.store',
            ]
        ];
        $grid = Grade::renderGrid($dataTableRequest, 'grades');
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
        $form = Grade::createFormForSchool($fb);
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
        $form = Grade::editFormForSchool($fb, ['id' => $id]);
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
