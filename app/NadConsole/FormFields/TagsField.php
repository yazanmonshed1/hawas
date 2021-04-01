<?php

namespace App\NadConsole\FormFields;

use App\Models\TextBookPart;

class TagsField implements FormFieldInterface
{
    public $options = [
        'id',
        'label',
        'required',
        'min',
        'max',
        'rules',
        'where',
        'parentId'
    ];

    public $type = 'tags';

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
        $model = new $modelOptions['name'];

        $this->tableName = $model->getTable();
        
        $this->modelName = $modelOptions['name'];
        
        $this->displayField = $modelOptions['displayField'];
        $this->saveField = $modelOptions['saveField'];
        
        $data = $model->select($modelOptions['displayField'], $modelOptions['saveField']);
        
        $this->addApi = $modelOptions['addApi'];
        
        if (array_key_exists('conditions', $modelOptions)) {
            $data->where($modelOptions['conditions']);
        }
        $this->list = $data->get()->toArray();
        return $this;
    }
}
