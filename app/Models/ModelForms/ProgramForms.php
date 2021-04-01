<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait ProgramForms
{

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required']);
        $fb->media('image', ['label' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('media', ['label' => 'images', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.programs.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $fb->text('name', ['label' => 'name', 'required' => true, 'rules' => 'required']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required']);
        $fb->media('image', ['label' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('media', ['label' => 'images', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.programs.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;

        return $fb;
    }
}
