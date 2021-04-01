<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class MultipleChoice extends Model
{
    public function choices()
    {
        return $this->hasMany(MultipleChoiceAnswer::class, 'multiple_choice_id', 'id');
    }
}
