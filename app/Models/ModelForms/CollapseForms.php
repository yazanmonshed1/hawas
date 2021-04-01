<?php

namespace App\Models\ModelForms;

use App\Models\Collapse;
use App\Models\TextBookPart;
use App\NadConsole\Services\FormBuilder;
use stdClass;

trait CollapseForms
{

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->hidden('text_book_part_id', ['value' => null]);
        $fb->media('media', ['label' => 'images', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.about-us-collapses.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function createForPart(FormBuilder $fb, $params)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->hidden('text_book_part_id', ['value' => $params['text_book_part_id']]);
        $fb->media('media', ['label' => 'images', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.about-us-collapses.index');
        $fb->ajax = true;
        $fb->callback = 'handleAddOrRemoveCollapseForPartResponse';
        $fb->model = new self;

        return $fb;
    }

    public static function editForPart(FormBuilder $fb, $params)
    {
        $collapse = Collapse::find($params['id']);
        $fb->text('title', ['label' => 'title', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->textarea('description', ['label' => 'description', 'required' => true, 'rules' => 'required|string|max:255']);
        $fb->hidden('text_book_part_id', ['value' => $collapse->text_book_part_id]);
        $fb->media('media', ['label' => 'images', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true]);

        $fb->successRedirect = route('admin.about-us-collapses.index');
        $fb->ajax = true;
        $fb->callback = 'handleAddOrRemoveCollapseForPartResponse';
        $fb->model = new self;

        return $fb;
    }
}
