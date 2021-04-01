<?php

namespace App\NadConsole\Facades;

use Illuminate\Support\Facades\Facade;

class DataManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'datamanager';
    }
}
