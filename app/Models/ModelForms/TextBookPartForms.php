<?php

namespace App\Models\ModelForms;

use App\Models\TextBook;
use App\NadConsole\Services\FormBuilder;

trait TextBookPartForms
{

    private static function getList()
    {
        return TextBook::all();
    }
    
    public static function createForm(FormBuilder $fb, $params)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'section_name', 'rules' => 'required|string|max:255']);
        $fb->hidden('text_book_id', ['value' => $params['text_book_id']]);
        $fb->ajax = true;
        $fb->callback = 'handlePartAddResponse';
        $fb->model = new self;

        return $fb;
    }

    public static function createForBookForm(FormBuilder $fb, $id)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'section_name', 'rules' => 'required|string|max:255']);
        $fb->belongsTo(
            'text_book_id',
            ['modelName' => 'App\Models\TextBook', 'displayField' => 'title', 'saveField' => 'id'],
            ['label' => 'text_book', 'required' => true, 'rules' => 'required', 'list' => self::getList(), 'value' => $id]
        );

        $fb->successRedirect = route('admin.text-book-parts.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $id)
    {
        $fb->text('title', ['label' => 'title', 'required' => true, 'placeholder' => 'section_name', 'rules' => 'required|string|max:255']);
        $fb->belongsTo(
            'text_book_id',
            ['modelName' => 'App\Models\TextBook', 'displayField' => 'title', 'saveField' => 'id'],
            ['label' => 'text_book', 'required' => true, 'rules' => 'required', 'list' => self::getList()]
        );
        $fb->successRedirect = route('admin.text-book-parts.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
