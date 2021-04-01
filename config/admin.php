<?php

// General Configuration for admin

$ar = json_decode(file_get_contents(public_path('admin/assets/languages/languages.json')), true);
$current_language = json_decode(file_get_contents(public_path('admin/assets/languages/languages-default.json')), true);
$menus=json_decode(file_get_contents(public_path('admin/assets/menus/menus.json')), true);
$menus_roles=json_decode(file_get_contents(public_path('admin/assets/menus/menus_roles.json')), true);

return [

    'editor'=>'phpstorm.sh',
    'languages' => $ar,
    'default_language' => $current_language['slug'],
    'lang_direction' => $current_language['dir'],
    'language_flag' => $current_language['flag'],
    'menus'=>$menus,
    'menus_roles'=>$menus_roles,
];


