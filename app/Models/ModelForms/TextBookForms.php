<?php

namespace App\Models\ModelForms;

use App\Models\TextBook;
use App\NadConsole\Services\FormBuilder;

trait TextBookForms
{

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->media('front_cover', ['label' => 'front_cover', 'required' => true, 'placeholder' => 'front_cover', 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->media('back_cover', ['label' => 'back_cover', 'required' => true, 'placeholder' => 'back_cover', 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);

        $fb->successRedirect = route('admin.text-books.index');
        $fb->ajax = true;
        $fb->model = new TextBook();

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->media('front_cover', ['label' => 'front_cover', 'required' => true, 'placeholder' => 'front_cover', 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->media('back_cover', ['label' => 'back_cover', 'required' => true, 'placeholder' => 'back_cover', 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);

        $fb->successRedirect = route('admin.text-books.index');
        $fb->ajax = true;
        $fb->model = new TextBook();

        return $fb;
    }
}
