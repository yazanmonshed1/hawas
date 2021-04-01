<?php

namespace App\Providers;

use App\NadConsole\Models\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('setting', function ($variable) {
            $variable = trim(str_replace('\'', '', $variable));
            $setting = Setting::where('name', $variable)->get()->first();
            return $setting ? $setting->value : null;
        });
    }
}
