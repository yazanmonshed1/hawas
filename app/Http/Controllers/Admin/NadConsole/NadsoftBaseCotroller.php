<?php

namespace App\Http\Controllers\Admin\NadConsole;

use App\Http\Controllers\Controller;
use App\NadConsole\Facades\DataManager;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NadsoftBaseCotroller extends Controller
{

    protected function validateRequest(Request $request, FormBuilder $form)
    {
        foreach ($form->fields as $field) {
            if (isset($field->rules) && $field->rules) {
                $validateArr[$field->name] = $field->rules;
            }
        }
        return Validator::make($request->all(), $validateArr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $form)
    {
        $validator = $this->validateRequest($request, $form);

        $json = $request->has('json') ? true : false;

        if ($validator->fails()) {
            return $this->sendResponseFail($validator->errors(), $json);
        }

        $data = $request->all();

        if (method_exists($this, 'alterDataBeforeSave')) {
            $data = call_user_func_array([$this, 'alterDataBeforeSave'], [$data]);
        }

        $model = $form->model->newInstance();

        $model = DataManager::setAndSave($model, $form->fields, $data);

        if (method_exists($this, 'postSave')) {
            $model = call_user_func_array([$this, 'postSave'], [$model, $data]);
        }

        return $this->sendResponseSuccess($model, $json, $form->successRedirect);
    }

    public function update(Request $request, FormBuilder $form, $id)
    {
        $validator = $this->validateRequest($request, $form);

        $json = $request->has('json') ? true : false;

        if ($validator->fails()) {
            return $this->sendResponseFail($validator->errors(), $json);
        }

        $data = $request->all();

        if (method_exists($this, 'alterDataBeforeUpdate')) {
            $data = call_user_func_array([$this, 'alterDataBeforeUpdate'], [$data]);
        }

        $model = $form->model->find($id);

        $model = DataManager::setAndSave($model, $form->fields, $data);

        if (method_exists($this, 'postUpdate')) {
            $model = call_user_func_array([$this, 'postUpdate'], [$model, $data]);
        }

        return $this->sendResponseSuccess($model, $json, $form->successRedirect);
    }

    public function sendResponseFail($errors, $json = false)
    {
        return $json ? response()->json([
            'errors' => $errors,
            'message' => 'validation error'
        ], 406) : redirect()->back()->withErrors($errors)->withInput();
    }

    public function sendResponseSuccess($data, $json, $successRedirect)
    {
        return $json ? response()->json([
            'data' => $data,
            'message' => 'success'
        ]) : redirect($successRedirect);
    }
}
