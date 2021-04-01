<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function multipleChoices()
    {
        return $this->belongsTo(BookContent::class, 'multiple_choices_id', 'id');
    }
}
