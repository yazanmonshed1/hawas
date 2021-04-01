<?php

namespace App\Models\ModelForms;

use App\NadConsole\Models\Role;
use App\NadConsole\Services\FormBuilder;

trait SliderForms
{
    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->text('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->media('image', ['label' => 'media', 'required' => true, 'rules' => 'required', 'multiple' => false]);

        $fb->successRedirect = route('admin.sliders.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->text('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->media('image', ['label' => 'media', 'required' => true, 'rules' => 'required', 'multiple' => false]);

        $fb->successRedirect = route('admin.sliders.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;

        return $fb;
    }
}
