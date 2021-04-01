<?php

namespace App\NadConsole\Models;

use App\NadConsole\Traits\NadsoftModelBase;
use Carbon\Carbon;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use NadsoftModelBase;

    public function getCreatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d') : null;
    }

    public function getUpdatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d') : null;
    }
}
