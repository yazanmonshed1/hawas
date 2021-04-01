<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Change Language
        $this->Language();
    }


    protected function Language()
    {
        setLocale(LC_TIME, 'ar');
        Carbon::setLocale('ar');
        if (Cookie::has('lang')) {
            $lang = Cookie::get('lang');
            if ($lang == 'ar') {
                App::setlocale('ar');
            } else if ($lang == 'he') {
                App::setlocale('he');
            } else {
                App::setlocale('en');
            }
        } else {
            App::setlocale('en');
        }
    }
}
