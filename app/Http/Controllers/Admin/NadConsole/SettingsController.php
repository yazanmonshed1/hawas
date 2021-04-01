<?php

namespace App\Http\Controllers\Admin\NadConsole;

use App\Http\Controllers\Controller;
use App\NadConsole\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy(function ($item, $key) {
            return explode('.', $item->name)[0];
        });
        return view('admin.settings.index')->with('settings', $settings);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'tabName');
        $keys = array_keys($data);
        foreach ($keys as $settingName) {
            $name = $request->tabName . '.' . ltrim($settingName, $request->tabName . '_');
            $setting = Setting::where(['name' => $name])->first();
            if ($setting) {
                $setting->value = $data[$settingName];
                $setting->save();
            }
        }
        session()->flash('success_message', __('admin.updated_successfully'));
        Artisan::call('optimize:clear');
        return redirect()->back();
    }
}
