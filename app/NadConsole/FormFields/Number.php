<?php

namespace App\NadConsole\FormFields;
class Number implements FormFieldInterface
{
    public $options = ['id', 'label', 'placeholder', 'required', 'pattern', 'min', 'max', 'rules'];

    public $type = 'number';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
