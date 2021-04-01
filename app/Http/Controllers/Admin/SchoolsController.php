<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Admin;
use App\Models\School;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SchoolsController extends NadsoftBaseCotroller
{

    public function __construct()
    {
        $this->nameSlug = 'schools';
    }

    public function postSave(School $school, $data)
    {
        $secretary = new Admin();
        $secretary->username = 'school' . $school->id;
        $secretary->name = $data['secretary_name'];
        $secretary->email = $data['secretary_email'];
        $secretary->avatar = $data['avatar'];
        $secretary->password = Hash::make($data['secretary_password']);
        $secretary->save();
        $secretary->assignRole('secretary');
        $school->secretary_id = $secretary->id;
        $school->save();
        return $school;
    }

    public function postUpdate(School $school, $data)
    {
        $secretary = $school->secretary;
        $secretary->username = 'school' . $school->id;
        $secretary->name = $data['secretary_name'];
        $secretary->email = $data['secretary_email'];
        $secretary->avatar = $data['avatar'];
        if ($data['secretary_password'] != null) {
            $secretary->password = Hash::make($data['secretary_password']);
        }
        $secretary->save();
        return $school;
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
            'routeSlug' => 'schools',
            'data' => [
                'modelName' => 'School',
                'searchCol' => 'name',
                'relationships' => [
                    'username' => 'secretary,username',
                    'books' => 'books,title,multiple,<br>',
                    'teachers' => 'teachers,name,multiple,<br>'
                ]
            ],
            'columns' => ['name', 'teachers', 'books', 'username'],
            'id' => 'schools-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.schools.update',
                'store_action' => 'admin.schools.store',
            ],
        ];
        $grid = School::renderGrid($dataTableRequest, 'schools');
        return view('admin.schools.index')->with([
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
        $action = route('admin.schools.store');
        $form = School::createForm($fb);
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
        $form = School::createForm($fb);
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
        $form = School::editForm($fb, ['id' => $id]);
        $model = School::findOrFail($id);
        $action = route('admin.schools.update', [$model->id]);
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
        $form = School::editForm($fb, ['id' => $id]);
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

    public function addBooks(Request $request, $id)
    {
        dd($id);
    }
}
