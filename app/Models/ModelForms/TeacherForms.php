<?php

namespace App\Models\ModelForms;

use App\Models\Grade;
use App\Models\Teacher;
use App\NadConsole\Services\FormBuilder;

trait TeacherForms
{
    public static function createForm(FormBuilder $fb)
    {
        $avatarData = ['label' => 'image', 'multiple' => false, 'default' => 'dummy/profile-img.png'];
        if (auth('teacher')->check()) {
            $avatarData['api'] = route('admin.teacher.upload');
        }
        $fb->hidden('school_id', ['value' => auth('admin')->user()->school->id]);
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', $avatarData);
        $fb->text('id_no', ['label' => 'national_id', 'required' => true, 'rules' => 'required']);
        $fb->text('phone_no', ['label' => 'phone_no', 'required' => true, 'rules' => 'required']);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'required' => true, 'rules' => 'required|email|unique:teachers']);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:teachers']);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => true, 'rules' => 'required|min:8|confirmed']);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => true, 'rules' => 'required|min:8', 'ignored' => true]);
        $fb->successRedirect = route('admin.teachers.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $avatarData = ['label' => 'image', 'multiple' => false];
        if (auth('teacher')->check()) {
            $avatarData['api'] = route('admin.teacher.upload');
            $avatarData['default'] = Teacher::find($params['id']->avatar);
        }
        $fb->hidden('school_id', ['value' => auth('admin')->user()->school->id]);
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', $avatarData);
        $fb->text('id_no', ['label' => 'national_id', 'required' => true, 'rules' => 'required']);
        $fb->text('phone_no', ['label' => 'phone_no', 'required' => true, 'rules' => 'required']);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'required' => true, 'rules' => 'required|email|unique:teachers,email,' . $params['id']]);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:teachers,username,' . $params['id']]);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => false]);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => true, 'rules' => 'nullable|min:8', 'ignored' => true]);

        $fb->successRedirect = route('admin.teachers.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
