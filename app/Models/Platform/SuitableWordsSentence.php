<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class SuitableWordsSentence extends Model
{
    public function choices()
    {
        return $this->hasMany(SuitableWordsSentencesChoice::class, 'sentence_id', 'id');
    }
}
