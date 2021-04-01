<?php

namespace App\Models\ModelForms;

use App\Models\Admin;
use App\Models\School;
use App\NadConsole\Models\Role;
use App\NadConsole\Services\FormBuilder;

trait SchoolForms
{

    protected static function secretaries()
    {
        $admins = Admin::role('secretary')->get();
        foreach ($admins as $admin) {
            $adminObject['name'] = $admin->name;
            $adminObject['id'] = $admin->id;
            $list[] = $adminObject;
        }
        return $list;
    }

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('name', ['label' => 'school_name', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        
        $fb->text('secretary_name', ['label' => 'secretary_name', 'required' => true, 'rules' => 'required|string', 'ignored' => true]);
        $fb->media('avatar', ['label' => 'secretary_avatar', 'required' => false, 'multiple' => false, 'ignored' => true]);
        $fb->text('secretary_email', ['label' => 'email', 'text_type' => 'email', 'required' => true, 'rules' => 'required|email|unique:admins,email', 'ignored' => true]);
        $fb->text('secretary_password', ['label' => 'secretary_password', 'text_type' => 'password', 'required' => true, 'rules' => 'required|string|min:8|max:255', 'ignored' => true]);

        $fb->hasMany(
            'books',
            ['modelName' => 'App\\Models\\DigitalBook', 'displayField' => 'title', 'saveField' => 'id', 'relationship' => 'books', 'foreignModel' => 'App\\Models\\DigitalBook'],
            ['label' => 'books']
        );

        $fb->successRedirect = route('admin.schools.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $admin = School::find($params['id'])->secretary;
        $fb->text('name', ['label' => 'school_name', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        
        $fb->text('secretary_name', ['label' => 'secretary_name', 'required' => true, 'rules' => 'required|string', 'ignored' => true, 'default' => $admin->name]);
        $fb->media('avatar', ['label' => 'secretary_avatar', 'required' => false, 'multiple' => false, 'ignored' => true, 'default' => $admin->avatar]);
        $fb->text('secretary_email', ['label' => 'email', 'text_type' => 'email', 'required' => true, 'rules' => 'required|email|unique:admins,email,' . $admin->id, 'default' => $admin->email, 'ignored' => true]);
        $fb->text('secretary_password', ['label' => 'secretary_password', 'text_type' => 'password', 'rules' => 'nullable|string|min:8|max:255', 'ignored' => true]);
        
        $fb->hasMany(
            'books',
            ['modelName' => 'App\\Models\\DigitalBook', 'displayField' => 'title', 'saveField' => 'id', 'relationship' => 'books', 'foreignModel' => 'App\\Models\\DigitalBook'],
            ['label' => 'books']
        );

        $fb->successRedirect = route('admin.schools.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
