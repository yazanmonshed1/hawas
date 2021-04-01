<?php

namespace App\NadConsole;

use Illuminate\Database\Eloquent\Model;

class DataManager
{
    /**
     * saveMany
     *
     * @param  array $syncArr
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveMany($syncArr, $model)
    {
        foreach ($syncArr as $relation) {
            $relationship = $model->{$relation['relationship']}();
            $foreignModel = new $relation['foreignModel']();
            $items = $foreignModel->find($relation['value']);
            $relationship->sync($items);
        }
        return $model;
    }

    /**
     * setAndSave
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  array $fields
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setAndSave(Model $model, $fields, $data)
    {
        $saveManyArr = [];
        foreach ($fields as $formField) {
            $type = $formField->type;
            $name = $formField->name;
            if (isset($formField->ignored) && $formField->ignored) continue;
            switch ($type) {
                case 'has-many':
                    $saveManyArr[] = [
                        'relationship' => $fields[$name]->relationship,
                        'foreignModel' => $fields[$name]->foreignModel,
                        'value' => array_key_exists($name, $data) ? $data[$name] : [],
                        'key' => $formField->saveField
                    ];
                    break;
                case 'tags':
                    $tags = $data[$name];
                    break;
                default:
                    $value = !array_key_exists($name, $data) ? null : $data[$name];
                    if ($value == null && $name == 'password') {
                        continue 2;
                    }
                    $model->setAttribute($name, $value);
            }
        }
        $model->save();
        if (isset($saveManyArr) && count($saveManyArr)) {
            return $this->saveMany($saveManyArr, $model);
        }
        if (isset($tags)) {
            $this->setTags($model, $tags);
        }
        return $model;
    }

    private function setTags($model, $tags)
    {
        $model->tags()->sync($tags);
        return $model;
    }
}
