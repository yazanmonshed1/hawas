<?php

namespace App\NadConsole\FormFields;

class HiddenField implements FormFieldInterface
{
    public $options = ['value', 'ignored'];

    public $type = 'hidden';

    public $ignored = true;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
