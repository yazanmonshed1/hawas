<?php

namespace App\NadConsole\FormFields;

class MediaField implements FormFieldInterface
{
    public $options = ['id', 'label', 'multiple', 'types', 'rules', 'saveField', 'ignored', 'default', 'required', 'file_type', 'api'];

    public $type = 'file-uploader';

    public $multiple = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }
}
