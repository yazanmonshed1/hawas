<?php

namespace App\NadConsole\FormFields;

class Text implements FormFieldInterface
{
    public $options = ['id', 'text_type', 'label', 'placeholder', 'required', 'pattern', 'rules', 'ignored', 'default'];

    public $type = 'text';

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
