<?php

namespace App\NadConsole\FormFields;

class SelectField implements FormFieldInterface
{
    public $options = ['id', 'label', 'rules', 'options', 'saveField', 'displayField', 'required', 'value'];

    public $type = 'select';

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
