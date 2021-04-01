<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->routeSlug = 'users';
        $this->nameSlug = 'users';
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
            'routeSlug' => $this->routeSlug,
            'data' => [
                'modelName' => 'User',
                'searchCol' => 'email',
                'relationships' => [
                    'books' => 'grade.books,title,multiple,<br>',
                    'grade' => 'grade,name',
                    'school' => 'grade.school,name'
                ]
            ],
            'columns' => ['avatar', 'name', 'grade', 'books', 'school', 'username'],
            'id' => 'users-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.users.update',
                'store_action' => 'admin.users.store',
            ]
        ];
        $grid = User::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    public function alterDataBeforeSave($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function alterDataBeforeUpdate($data)
    {
        if ($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $fb)
    {
        $action = route('admin.users.store');
        $form = User::createForm($fb);
        return view('admin.dashboard.general.add-edit')->with([
            'form' => $form->render($action),
            'nameSlug' => $this->nameSlug
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $fb)
    {
        $form = User::createForm($fb);
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
    public function edit(FormBuilder $fb, $id)
    {
        $model = User::findOrFail($id);
        $action = route('admin.users.update', [$model->id]);
        $form = User::editForm($fb, ['id' => $id]);
        $model = $form->model->findOrFail($id);
        return view('admin.dashboard.users.add-edit')->with([
            'form' => $form->render($action, $model)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $fb, $id)
    {
        $form = User::editForm($fb, ['id' => $id]);
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
        $model->assignRole('student');
        return $model;
    }
}
