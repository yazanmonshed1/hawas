<?php

namespace App\NadConsole\FormFields;

class BooleanField implements FormFieldInterface
{
    public $options = ['id', 'label', 'rules'];

    public $type = 'boolean';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
