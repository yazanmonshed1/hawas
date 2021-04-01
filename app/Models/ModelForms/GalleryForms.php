<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait GalleryForms
{

    public static function createForm(FormBuilder $fb)
    {
        $fb->media('media', ['label' => 'gallery', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);
        
        $fb->successRedirect = route('admin.about-us-collapses.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb)
    {
        $fb->media('media', ['label' => 'gallery', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.about-us-collapses.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
