<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Teacher;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends NadsoftBaseCotroller
{

    public function getForm($fb, $params)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', ['label' => 'image', 'multiple' => false, 'api' => route('admin.teacher.upload')]);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'rules' => 'nullable|email|unique:admins,email,' . $params['id']]);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:admins,username,' . $params['id']]);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => false, 'rules' => 'nullable|min:8|confirmed']);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => false, 'rules' => 'nullable|min:8', 'ignored' => true]);

        $fb->successRedirect = route('teacher.home');
        $fb->model = new Teacher();

        return $fb;
    }

    public function index(FormBuilder $fb)
    {
        $action = route('admin.teacher.profile.update');
        $model = auth('teacher')->user();
        $form = $this->getForm($fb, ['id' => $model->id])->render($action, $model);
        return view('admin.dashboard.general.add-edit')->with([
            'form' => $form,
            'nameSlug' => 'profiles'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $fb, $id = null)
    {
        $uid = auth('teacher')->user()->id;
        $form = $this->getForm($fb, ['id' => $uid]);
        return parent::update($request, $form, $uid);
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
}
