<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class MatchWordToSentence extends Model
{
    public function items()
    {
        return $this->hasMany(MatchWordsToSentencesWord::class, 'match_word_to_sentence_id', 'id');
    }
}
