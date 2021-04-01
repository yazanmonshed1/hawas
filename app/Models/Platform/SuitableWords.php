<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class SuitableWords extends Model
{
    public function sentences()
    {
        return $this->hasMany(SuitableWordsSentence::class, 'suitable_word_id', 'id');
    }
}
