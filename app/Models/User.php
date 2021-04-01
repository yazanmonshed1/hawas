<?php

namespace App\Models;

use App\Models\ModelForms\UserForms;
use App\Models\Platform\StudentExam;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, NadsoftModelBase, UserForms, HasRoles, HasApiTokens;

    protected $slug = 'users';

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hook_column_avatar_pre_render($item)
    {
        return '<img style="max-width: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_grade_id_pre_render($item)
    {
        return $item ? $item->name . ' - ' . $item->school->name : null;
    }

    public function hook_column_created_at_pre_render($item)
    {
        return $item->format('d-m-Y');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function filterData()
    {
        if (auth('admin')->check()) {
            /** @var \App\Models\Admin $admin */
            $admin = auth('admin')->user();
            if ($admin->hasRole('secretary')) {
                $grades = $admin->school->grades->pluck('id');
                return $this->whereIn('grade_id', $grades);
            }
        }

        return $this;
    }

    public function exams()
    {
        return $this->hasMany(StudentExam::class, 'user_id', 'id');
    }
}
