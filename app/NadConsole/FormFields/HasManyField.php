<?php

namespace App\NadConsole\FormFields;

class HasManyField implements FormFieldInterface
{
    public $options = ['id', 'label', 'rules'];

    public $type = 'has-many';

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
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $modelOptions['modelName'];

        $this->modelName = $modelOptions['modelName'];

        $this->relationship = $modelOptions['relationship'];
        $this->foreignModel = $modelOptions['foreignModel'];

        $this->displayField = $modelOptions['displayField'];
        $this->saveField = $modelOptions['saveField'];

        if (array_key_exists('list', $modelOptions)) {
            $this->list = $modelOptions['list'];
        } else {
            $data = $model->select($modelOptions['displayField'], $modelOptions['saveField']);
    
            if (array_key_exists('conditions', $modelOptions)) {
                $data->where($modelOptions['conditions']);
            }
            $this->list = $data->get()->toArray();
        }
        return $this;
    }
}
