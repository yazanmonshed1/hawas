<?php

namespace App\Models;

use App\NadConsole\Traits\NadsoftModelBase;

class Message extends Contact
{
    use NadsoftModelBase;

    protected $slug = 'messages';

    protected $table = 'contacts';
}
