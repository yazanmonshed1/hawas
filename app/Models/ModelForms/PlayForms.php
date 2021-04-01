<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait PlayForms
{

    private static function getTypes()
    {
        return [
            [
                'id' => 'play',
                'text' => __('Play')
            ],
            [
                'id' => 'film',
                'text' => __('Film')
            ]
        ];
    }

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->select('type', ['label' => 'type', 'required' => true, 'rules' => 'required', 'options' => self::getTypes(), 'saveField' => 'id', 'displayField' => 'text']);
        $fb->media('header_image', ['label' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('image', ['label' => 'header_image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('video', ['label' => 'video', 'file_type' => 'video', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('media', ['label' => 'gallery', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required']);

        $fb->successRedirect = route('admin.plays.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $params)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->select('type', ['label' => 'type', 'required' => true, 'rules' => 'required', 'options' => self::getTypes(), 'saveField' => 'id', 'displayField' => 'text']);
        $fb->media('header_image', ['label' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('image', ['label' => 'header_image', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('video', ['label' => 'video', 'file_type' => 'video', 'required' => true, 'rules' => 'required', 'multiple' => false]);
        $fb->media('media', ['label' => 'gallery', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required']);

        $fb->successRedirect = route('admin.plays.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
