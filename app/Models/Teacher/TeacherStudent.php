<?php

namespace App\Models\Teacher;

use App\Models\User;

class TeacherStudent extends User
{
    protected $table = 'users';

    public function newQuery()
    {
        $teacher = auth('teacher')->user();
        $grades = $teacher->grade->id;
        return parent::newQuery()
            ->where('grade_id', $grades);
    }
}
