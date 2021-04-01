<?php

namespace App\Models;

use App\Models\ModelForms\GradeForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use NadsoftModelBase, GradeForms;

    protected $slug = 'grades';

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function books()
    {
        return $this->belongsToMany(DigitalBook::class, 'grade_books', 'grade_id', 'book_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function filterData()
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth('admin')->user();

        if ($admin->hasRole('secretary')) {
            return $this->where('school_id', $admin->school->id);
        }
        return $this;
    }

    public function students()
    {
        return $this->hasMany(User::class, 'grade_id', 'id');
    }
}
