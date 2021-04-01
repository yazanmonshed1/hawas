<?php

namespace App\NadConsole\FormFields;

class RichTextEditorField implements FormFieldInterface
{
    public $options = ['id', 'text_type', 'label', 'required', 'rules', 'default'];

    public $type = 'rich-text-editor';

    public $ignored = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
