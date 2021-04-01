<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function ChangeLanguage($lang)
    {

        if ($lang == 'ar') //Arabic
            Cookie::queue(Cookie::make('lang', 'ar', 60 * 60 * 24 * 20));
        else if ($lang == 'he')  //Hebrew
            Cookie::queue(Cookie::make('lang', 'he', 60 * 60 * 24 * 20));

        else   //English
            Cookie::queue(Cookie::make('lang', 'en', 60 * 60 * 24 * 20));

        return redirect()->back();
    }
}
