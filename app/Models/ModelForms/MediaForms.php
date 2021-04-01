<?php

namespace App\Models\ModelForms;

use App\NadConsole\Services\FormBuilder;

trait MediaForms
{

    public static function createForm(FormBuilder $fb, $model = null)
    {
        $optionsArr = ['label' => __('Media'), 'required' => true, 'placeholder' => __('Media'), 'rules' => 'required', 'multiple' => true, 'saveField' => 'id'];


        $fb->media('media', $optionsArr);

        if ($model) {
            $fb->model = new self;
        }

        return $fb;
    }

    public static function generateMediaField(FormBuilder $fb, $model = null)
    {
        $optionsArr = ['label' => __('Media'), 'required' => true, 'placeholder' => __('Media'), 'rules' => 'required'];


        $fb->media('media', $optionsArr);

        if ($model) {
            $fb->model = new self;
        }

        return $fb;
    }
}
