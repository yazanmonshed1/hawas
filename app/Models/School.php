<?php

namespace App\Models;

use App\Models\ModelForms\SchoolForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use NadsoftModelBase, SchoolForms;

    protected $slug = 'schools';

    public function secretary()
    {
        return $this->belongsTo(Admin::class, 'secretary_id', 'id');
    }

    public function books()
    {
        return $this->belongsToMany(DigitalBook::class, 'school_books', 'school_id', 'book_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'school_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'school_id', 'id');
    }
}
