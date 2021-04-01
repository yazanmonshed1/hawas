<?php

namespace App\NadConsole\FormFields;

class DatePicker implements FormFieldInterface
{
    public $options = ['id', 'label', 'required', 'pattern', 'format', 'min', 'max', 'rules'];

    public $type = 'date-picker';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
