<?php

namespace App\Models;

use App\Models\ModelForms\TeacherForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Admin
{
    use Notifiable, NadsoftModelBase, TeacherForms, HasRoles;

    protected $table = 'teachers';

    protected $slug = 'teachers';

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function filterData()
    {
        /** @var \self $admin */
        $admin = auth('admin')->user();

        if ($admin->hasRole('secretary')) {
            return $this->where('school_id', $admin->school->id);
        }
        return $this;
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function grade() {
        return $this->hasOne(Grade::class, 'teacher_id', 'id');
    }

    public function grades() {
        return $this->hasMany(Grade::class, 'teacher_id', 'id');
    }
}
