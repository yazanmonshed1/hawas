<?php

namespace App\Http\Controllers\Admin\NadConsole;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function ChangeLanguage($slug)
    {

        $Languages = config('admin.languages');
        foreach ($Languages as $language) {
            if ($language['slug'] == $slug) {
                $Language_file = ['slug' => $slug, 'display_name' => $language['display_name'], 'dir' => $language['dir'], 'flag' => $language['flag']];
                file_put_contents(public_path('admin/assets/languages/languages-default.json'), json_encode($Language_file));
                app()->setLocale($slug);
                session(['locale' => $slug]);
                return redirect()->back();
            }
        }
    }
}
