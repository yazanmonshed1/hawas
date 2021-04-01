<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait BlogForms
{

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->text('brief', ['label' => 'brief', 'required' => true, 'placeholder' => 'brief', 'rules' => 'required|string|max:255']);
        $fb->media('image', ['label' => 'image', 'required' => true, 'multiple' => false, 'rules' => 'required']);
        $fb->richTextEditor('body', ['label' => 'description', 'required' => true]);

        $fb->successRedirect = route('admin.blogs.index');
        $fb->ajax = false;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $id)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->text('brief', ['label' => 'brief', 'required' => true, 'placeholder' => 'brief', 'rules' => 'required|string|max:255']);
        $fb->media('image', ['label' => 'image', 'required' => true, 'multiple' => false, 'rules' => 'required']);
        $fb->richTextEditor('body', ['label' => 'description', 'required' => true]);

        $fb->successRedirect = route('admin.blogs.index');
        $fb->ajax = false;
        $fb->model = new self;

        return $fb;
    }
}
