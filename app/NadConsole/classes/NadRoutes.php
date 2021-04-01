<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/01/21
 * Time: 02:25 م
 */

namespace App\NadConsole\classes;


class NadRoutes
{
    public static function routes(){
        include base_path('app/NadConsole/config/routes.php');
    }
}
