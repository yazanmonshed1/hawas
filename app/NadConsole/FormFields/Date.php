<?php

namespace App\NadConsole\FormFields;

class Date implements FormFieldInterface
{
    public $options = ['id', 'label', 'placeholder', 'required', 'pattern', 'format', 'min', 'max', 'rules'];

    public $type = 'date';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
