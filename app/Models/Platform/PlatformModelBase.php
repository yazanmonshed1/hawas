<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class PlatformModelBase extends Model
{
    public function bookContent()
    {
        return $this->belongsTo(BookContent::class, 'book_content_id', 'id');
    }
}
