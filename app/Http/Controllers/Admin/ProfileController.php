<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Admin;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends NadsoftBaseCotroller
{

    public function getForm($fb, $params)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->media('avatar', ['label' => 'image', 'required' => false, 'multiple' => false]);
        $fb->text('email', ['label' => 'email', 'text_type' => 'email', 'rules' => 'nullable|email|unique:admins,email,' . $params['id']]);
        $fb->text('username', ['label' => 'username', 'required' => true, 'rules' => 'required|unique:admins,username,' . $params['id']]);
        $fb->text('password', ['label' => 'password', 'text_type' => 'password', 'required' => true, 'rules' => 'nullable|min:8|confirmed']);
        $fb->text('password_confirmation', ['label' => 'password_confirmation', 'text_type' => 'password', 'required' => true, 'rules' => 'nullable|min:8', 'ignored' => true]);

        $fb->successRedirect = route('admin.home');
        $fb->model = new Admin();

        return $fb;
    }

    public function index(FormBuilder $fb)
    {
        $action = route('admin.profile.update');
        $model = auth('admin')->user();
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
        $uid = auth()->user()->id;
        $form = $this->getForm($fb, ['id' => $uid]);
        session()->flash('success_message', 'تم تحديث الملف الشخصي');
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
