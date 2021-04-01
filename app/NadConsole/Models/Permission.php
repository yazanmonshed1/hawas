<?php

namespace App\NadConsole\Models;

use App\Models\ModelForms\PermissionForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use NadsoftModelBase, PermissionForms;

    public function getCreatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d') : null;
    }

    public function getUpdatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d') : null;
    }
}
