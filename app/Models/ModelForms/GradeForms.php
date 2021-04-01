<?php

namespace App\Models\ModelForms;

use App\Models\School;
use App\Models\Teacher;
use App\NadConsole\Services\FormBuilder;

trait GradeForms
{

    private static function getBooks()
    {
        return auth('admin')->user()->school->books->toArray();
    }

    private static function getTeachers($id = null)
    {
        $school = auth('admin')->user()->school;

        $teachers = [];
        foreach ($school->grades as $grade) {
            if ($id) {
                if ($id != $grade->id) {
                    $teachers[] = $grade->teacher_id;
                }
            } else {
                $teachers[] = $grade->teacher_id;
            }
        }

        return $school->teachers()->whereNotIn('id', $teachers)->get();
    }

    public static function createForm(FormBuilder $fb)
    {
        $fb->text('name', ['label' => 'grade', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->belongsTo(
            'school_id',
            ['modelName' => 'App\Models\School', 'displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'school', 'required' => true, 'rules' => 'required', 'list' => School::all()]
        );

        $fb->successRedirect = route('admin.schools.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editForm(FormBuilder $fb, $id)
    {
        $fb->text('name', ['label' => 'grade', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->belongsTo(
            'school_id',
            ['modelName' => 'App\Models\School', 'displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'school', 'required' => true, 'rules' => 'required', 'list' => School::all()]
        );

        $fb->successRedirect = route('admin.schools.index');
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function editFormForSchool(FormBuilder $fb, $params)
    {
        $fb->text('name', ['label' => 'grade', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->hasMany(
            'books',
            ['modelName' => 'App\\Models\\DigitalBook', 'displayField' => 'title', 'saveField' => 'id', 'relationship' => 'books', 'foreignModel' => 'App\\Models\\DigitalBook', 'list' => self::getBooks()],
            ['label' => 'books']
        );
        $fb->belongsTo(
            'teacher_id',
            ['displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'teacher', 'required' => true, 'rules' => 'required', 'list' => self::getTeachers($params['id'])]
        );
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }

    public static function createFormForSchool(FormBuilder $fb)
    {
        $fb->text('name', ['label' => 'grade', 'required' => true, 'placeholder' => 'title', 'rules' => 'required|string|max:255']);
        $fb->hasMany(
            'books',
            ['modelName' => 'App\\Models\\DigitalBook', 'displayField' => 'title', 'saveField' => 'id', 'relationship' => 'books', 'foreignModel' => 'App\\Models\\DigitalBook', 'list' => self::getBooks()],
            ['label' => 'books']
        );
        $fb->belongsTo(
            'teacher_id',
            ['displayField' => 'name', 'saveField' => 'id'],
            ['label' => 'teacher', 'required' => true, 'rules' => 'required', 'list' => self::getTeachers()]
        );
        $fb->hidden('school_id', ['value' => auth('admin')->user()->school->id]);
        $fb->ajax = true;
        $fb->model = new self;

        return $fb;
    }
}
