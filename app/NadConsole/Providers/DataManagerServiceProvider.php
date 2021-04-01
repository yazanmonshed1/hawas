<?php

namespace App\NadConsole\Providers;

use App\NadConsole\DataManager;
use Illuminate\Support\ServiceProvider;

class DataManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('datamanager', function () {
            return new DataManager();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
