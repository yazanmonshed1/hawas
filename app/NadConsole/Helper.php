<?php

namespace App\NadConsole;

use App\NadConsole\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function setting($variable)
    {
        $setting = Setting::where('name', $variable)->get()->first();
        return $setting ? $setting->value : null;
    }
}
