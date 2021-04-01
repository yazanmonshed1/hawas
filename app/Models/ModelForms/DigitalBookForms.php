<?php

namespace App\Models\ModelForms;

use App\Models\Grade;
use App\NadConsole\Services\FormBuilder;

trait DigitalBookForms
{

    protected static function greades()
    {
        $grades = Grade::all();
        foreach ($grades as $grade) {
            $gradeObject['name'] = $grade->name . ' - ' . $grade->school->name;
            $gradeObject['id'] = $grade->id;
            $list[] = $gradeObject;
        }
        return $list;
    }

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => __('Title'), 'rules' => 'required|string|max:255']);
        $fb->text('description', ['label' => 'description', 'required' => true, 'placeholder' => __('Description'), 'rules' => 'required|string|max:255']);
        $fb->media('intro', ['label' => 'intro', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->media('cover_image', ['label' => 'cover_image', 'file_type' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->successRedirect = route('admin.digital-books.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => __('Title'), 'rules' => 'required|string|max:255']);
        $fb->text('description', ['label' => 'description', 'required' => true, 'placeholder' => __('Description'), 'rules' => 'required|string|max:255']);
        $fb->media('intro', ['label' => 'intro', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->media('cover_image', ['label' => 'cover_image', 'file_type' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id']);
        $fb->successRedirect = route('admin.digital-books.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
