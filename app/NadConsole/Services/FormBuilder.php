<?php

namespace App\NadConsole\Services;

use App\NadConsole\FormFields\BelongsToField;
use App\NadConsole\FormFields\BooleanField;
use App\NadConsole\FormFields\Date;
use App\NadConsole\FormFields\DatePicker;
use App\NadConsole\FormFields\HasManyField;
use App\NadConsole\FormFields\Number;
use App\NadConsole\FormFields\SelectField;
use App\NadConsole\FormFields\SelectMultipleField;
use App\NadConsole\FormFields\TagsField;
use App\NadConsole\FormFields\Text;
use App\NadConsole\FormFields\TextAreaField;
use App\NadConsole\FormFields\FileField;
use App\NadConsole\FormFields\MediaField;
use App\NadConsole\FormFields\RichTextEditorField;
use App\NadConsole\FormFields\HiddenField;
use stdClass;

class FormBuilder
{

    /**
     * fields
     * 
     * Array of fields as objects
     *
     * @var array
     */
    public $fields = [];

    /**
     * successRedirect
     * 
     * redirect path if request is not json
     *
     * @var string
     */
    public $successRedirect = '';

    /**
     * ajax
     * 
     * submit form via ajax - default (false)
     *
     * @var boolean
     */
    public $ajax = false;

    /**
     * id
     * 
     * id of the form
     *
     * @var string
     */
    public $id;

    /**
     * classes
     * 
     * HTML classes of the form
     *
     * @var string
     */
    public $classes;

    /**
     * classes
     * 
     * HTML classes of the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * classes
     * 
     * Js file name in admin/scripts/{$additional_script}
     *
     * @var string
     */
    public $additional_script = null;

    /**
     * classes
     * 
     * Js function callback
     *
     * @var string
     */
    public $callback;

    /**
     * text
     * 
     * Make Text
     *
     * @param  mixed $name
     * @param  mixed $placeholder
     * @return void
     */
    public function text($name, $options = [])
    {
        $field = new Text($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * textarea
     * 
     * Make Text area
     *
     * @param  mixed $name
     * @param  mixed $placeholder
     * @return void
     */
    public function textarea($name, $options = [])
    {
        $field = new TextAreaField($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * textarea
     * 
     * Make Text area
     *
     * @param  mixed $name
     * @param  mixed $placeholder
     * @return void
     */
    public function richTextEditor($name, $options = [])
    {
        $field = new RichTextEditorField($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * number
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return void
     */
    public function number($name, $options = [])
    {
        $field = new Number($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * date
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return void
     */
    public function date($name, $options = [])
    {
        $field = new Date($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * date
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return void
     */
    public function datePicker($name, $options = [])
    {
        $field = new DatePicker($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * boolean
     * 
     * Creates On/Off field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return void
     */
    public function boolean($name, $options = [])
    {
        $field = new BooleanField($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * tags
     * 
     * Creates Multiple Tags fields
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return void
     */
    public function tags($name, $modelOptions, $options = [])
    {
        $field = new TagsField($name);

        $field->build($modelOptions);

        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * select
     * 
     * Creates Select dropdown field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return $field
     */
    public function select($name, $options = [])
    {
        $field = new SelectField($name);
        $this->fields[$name] = $this->setFields($field, $options);
        return $field;
    }

    /**
     * file
     * 
     * Creates Select dropdown field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return $field
     */
    public function file($name, $options = [])
    {
        $field = new FileField($name);
        $this->fields[$name] = $this->setFields($field, $options);
        return $field;
    }

    /**
     * select
     * 
     * Creates Select dropdown field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return $field
     */
    public function selectMultiple($name, $options = [])
    {
        $field = new SelectMultipleField($name);
        $this->fields[$name] = $this->setFields($field, $options);
        return $field;
    }

    /**
     * media
     * 
     * Creates Media dropzone
     *
     * @param  mixed $name
     * @param  mixed $options
     * @return $field
     */
    public function media($name, $options = [])
    {
        $field = new MediaField($name);
        $this->fields[$name] = $this->setFields($field, $options);
        return $field;
    }

    /**
     * select
     * 
     * Creates Select dropdown field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @param  string $modelOptions
     * @return void
     */
    public function hasMany($name, $modelOptions, $options = [])
    {
        $field = new HasManyField($name);

        $field->build($modelOptions);

        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * select
     * 
     * Creates Select dropdown field
     *
     * @param  mixed $name
     * @param  mixed $options
     * @param  string $modelOptions
     * @return void
     */
    public function belongsTo($name, $modelOptions, $options = [])
    {
        $field = new BelongsToField($name);

        $field->build($modelOptions);

        $this->fields[$name] = $this->setFields($field, $options);
    }

    /**
     * slot
     * 
     * @param  mixed $name
     * @return void
     */
    public function extraField($name, $data = null)
    {
        $field = new stdClass();
        $field->view = view('admin.dashboard.extra-fields.' . $name)->with('data', $data)->render();
        $field->type = 'extra-field';
        $field->ignored = true;
        $this->fields[$name] = $field;
    }

    /**
     * slot
     * 
     * @param  mixed $name
     * @return void
     */
    public function hidden($name, $options)
    {
        $field = new HiddenField($name);
        $this->fields[$name] = $this->setFields($field, $options);
    }

    public function render($action, $model = null)
    {
        return view('admin.form.index')->with([
            'form' => $this,
            'model' => $model ? (object)$model->getOriginal() : null,
            'relationshipsModel' => $model ? $model : null,
            'action' => $action,
            'additional_script' => $this->additional_script
        ])->render();
    }

    /**
     * setFields
     *
     * @return void
     */
    private function setFields($field, $options)
    {
        foreach ($field->options as $key) {
            if (array_key_exists($key, $options)) {
                $field->set($key, $options[$key]);
            } else {
                $field->set($key, null);
            }
        }

        return $field;
    }
}
