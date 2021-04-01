<?php


use Illuminate\Support\Facades\Route;
use \App\NadConsole\classes\NadRoutes;

Route::middleware(['web'])->name('admin.')->namespace('Admin')->group(function () {
    // Login Routes
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('loginAction');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::get('/', 'NadConsole\DashboardController@index')->name('home')->middleware('auth:admin');
    Route::get('change-language/{slug}', 'NadConsole\LanguageController@ChangeLanguage')->name('language')->middleware('auth:admin');
    Route::resource('media', 'NadConsole\MediaController')->middleware('auth:admin');
    Route::post('upload', 'NadConsole\MediaController@uploadImage')->middleware('auth:admin')->name('media.upload');

    Route::get('settings', 'NadConsole\SettingsController@index')->middleware('auth:admin')->name('settings.index');
    Route::post('settings', 'NadConsole\SettingsController@update')->middleware('auth:admin')->name('settings.update');

    Route::get('/get-data/datatable', 'GeneralApiController@getDatatable')->name('get-data.datatable');
    Route::get('/get-data/select2/{tableName}', 'GeneralApiController@getSelect2Data')->name('get-data.select');
    Route::get('/get-data/form/{id}', 'GeneralApiController@getForm')->name('get-data.get-form');
    Route::get('/get-data/new-form/{id}', 'GeneralApiController@getNewForm')->name('get-data.get-new-form');
    Route::get('/get-data/show-item', 'GeneralApiController@showItem')->name('get-data.show-item');
    Route::post('/delete-row/{id}', 'GeneralApiController@destroy')->name('delete-row');

    // Roles and Permissions
    Route::get('/roles/permissions/{guardName}/{id?}', 'NadConsole\Users\RolesController@getPermissions')->middleware('auth:admin')->name('roles.permissions');
    Route::resource('/roles', 'NadConsole\Users\RolesController')->middleware('auth:admin');

    Route::get('/permissions/generator', 'NadConsole\Users\PermissionsController@generator')->middleware('auth:admin')->name('permissions.generator');
    Route::post('/permissions/generate', 'NadConsole\Users\PermissionsController@generate')->middleware('auth:admin')->name('permissions.generate');
    Route::resource('/permissions', 'NadConsole\Users\PermissionsController')->middleware('auth:admin');

    Route::post('teacher/media', 'NadConsole\MediaController@store')->middleware('auth:teacher')->name('teacher.upload');

    NadRoutes::routes();
});

Route::middleware(['web'])->name('teacher.')->namespace('Teacher')->group(function () {
    Route::get('/teacher', 'DashboardController@index')->name('home')->middleware('auth:teacher');
    Route::namespace('Auth')->group(function () {
        Route::get('/teacher/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/teacher/login', 'LoginController@login')->name('loginAction');
        Route::post('/teacher/logout', 'LoginController@logout')->name('logout');
    });
});
