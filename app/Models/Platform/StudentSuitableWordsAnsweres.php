<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class StudentSuitableWordsAnsweres extends Model
{
    //

    public function answer()
    {
        return $this->belongsTo(SuitableWordsSentencesChoice::class, 'answer_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(SuitableWordsSentence::class, 'question_id', 'id');
    }
}
