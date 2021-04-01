<?php

namespace App\NadConsole\FormFields;

class FileField implements FormFieldInterface
{
    public $options = ['id', 'accept', 'label', 'required', 'rules',];

    public $type = 'file';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
