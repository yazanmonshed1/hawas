<?php

namespace App\NadConsole\FormFields;

class SelectMultipleField implements FormFieldInterface
{
    public $options = ['id', 'label', 'rules', 'ignored', 'displayField', 'saveField', 'required'];

    public $type = 'select-multiple';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }

    public function options($options) {
        $this->options = $options;
    }
}
