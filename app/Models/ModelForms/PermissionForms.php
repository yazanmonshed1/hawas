<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait PermissionForms
{

    public static function defaultForm(FormBuilder $fb, $params = null)
    {
        $fb->text('name', ['label' => 'Name', 'required' => true, 'placeholder' => 'Permission name', 'rules' => 'required|string|max:255']);
        $fb->text('table_name', ['label' => 'Table', 'placeholder' => 'Table name']);
        $fb->text('guard_name', ['label' => 'Guard', 'required' => true, 'placeholder' => 'Guard name', 'default' => 'admin', 'rules' => 'required']);

        $fb->successRedirect = route('admin.permissions.index');
        $fb->ajax = false;
        $fb->model = new self;

        return $fb;
    }
}
