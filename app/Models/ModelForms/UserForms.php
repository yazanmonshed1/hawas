<?php

namespace App\Models\ModelForms;

use App\Models\Grade;
use App\NadConsole\Services\FormBuilder;

trait UserForms
{

    private static function grades()
    {
        /** @var \App\Models\Admin $admin  */
        $admin = auth('admin')->user();
        if ($admin->hasRole('secretary')) {
            $list = Grade::where('school_id', auth('admin')->user()->school->id)->get()->toArray();
        } else {
            $grades = Grade::all();
            $list = [];
            foreach ($grades as $index => $grade) {
                $list[$index]['id'] = $grade->id;
                $list[$index]['name'] = $grade->school->name . ' - ' . $grade->name;
            }
        }
        return $list;
    }

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', ['label' => 'image', 'required' => true, 'multiple' => false, 'rules' => 'required', 'default' => 'dummy/profile-img.png']);
        $fb->text('id_no', ['label' => 'national_id', 'required' => true, 'rules' => 'required']);
        $fb->text('phone_no', ['label' => 'phone_no']);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'rules' => 'nullable|email|unique:users']);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:users']);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => true, 'rules' => 'required|min:8|confirmed']);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => true, 'rules' => 'required|min:8', 'ignored' => true]);
        $fb->belongsTo(
            'grade_id',
            ['displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'grade', 'required' => true, 'rules' => 'required', 'list' => self::grades()]
        );

        $fb->successRedirect = route('admin.users.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', ['label' => 'image', 'required' => true, 'multiple' => false, 'rules' => 'required']);
        $fb->text('id_no', ['label' => 'national_id', 'required' => true, 'rules' => 'required']);
        $fb->text('phone_no', ['label' => 'phone_no']);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'rules' => 'nullable|email|unique:users,email,' . $params['id']]);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:users,username,' . $params['id']]);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => false, 'rules' => 'nullable|min:8|confirmed']);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => true, 'rules' => 'nullable|min:8', 'ignored' => true]);
        $fb->belongsTo(
            'grade_id',
            ['displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'grade', 'required' => true, 'rules' => 'required', 'list' => self::grades()]
        );

        $fb->successRedirect = route('admin.users.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
