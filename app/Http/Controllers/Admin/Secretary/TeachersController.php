<?php

namespace App\Http\Controllers\Admin\Secretary;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeachersController extends NadsoftBaseCotroller
{
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

    public function __construct()
    {
        $this->nameSlug = 'teachers';
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
            'routeSlug' => 'teachers',
            'data' => [
                'modelName' => 'Teacher',
                'searchCol' => 'email'
            ],
            'columns' => ['email'],
            'id' => 'users-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.teachers.update',
                'store_action' => 'admin.teachers.store',
            ]
        ];
        $grid = Teacher::renderGrid($dataTableRequest, 'teachers');
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    public function store(Request $request, FormBuilder $form)
    {
        $form = Teacher::createForm($form);
        return parent::store($request, $form);
    }

    public function update(Request $request, FormBuilder $form, $id)
    {
        $form = Teacher::editForm($form, ['id' => $id]);
        return parent::update($request, $form, $id);
    }

    public function postSave($teacher, $data)
    {
        $teacher->assignRole('teacher');
        return $teacher;
    }

    public function postUpdate($teacher, $data)
    {
        $teacher->assignRole('teacher');
        return $teacher;
    }
}
