<?php

namespace App\NadConsole\Models;

use App\Models\ModelForms\MediaForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use NadsoftModelBase, MediaForms;
}
