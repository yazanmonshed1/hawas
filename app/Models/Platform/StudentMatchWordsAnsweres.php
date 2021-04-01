<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class StudentMatchWordsAnsweres extends Model
{
    public function sentence()
    {
        return $this->belongsTo(MatchWordsToSentencesWord::class, 'question_id', 'id');
    }
}
