<?php

namespace App\NadConsole\FormFields;

class BelongsToField implements FormFieldInterface
{
    public $options = ['id', 'label', 'rules', 'required', 'value', 'list', 'ignored'];

    public $type = 'belongs-to';

    public $required = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($key, $val)
    {
        $this->{$key} = $val;
    }

    public function build($modelOptions)
    {
        if (array_key_exists('modelName', $modelOptions)) {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            $model = new $modelOptions['modelName'];
            $data = $model->select($modelOptions['displayField'], $modelOptions['saveField']);
    
            if (array_key_exists('conditions', $modelOptions)) {
                $data->where($modelOptions['conditions']);
            }
            $this->list = $data->get()->toArray();
        }

        $this->displayField = $modelOptions['displayField'];
        $this->saveField = $modelOptions['saveField'];

        return $this;
    }
}
