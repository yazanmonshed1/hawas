<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class StudentMultipleChoiceAnswer extends Model
{
    public function question()
    {
        return $this->belongsTo(MultipleChoice::class, 'question_id', 'id');
    }

    public function answer()
    {
        return $this->belongsTo(MultipleChoiceAnswer::class, 'answer_id', 'id');
    }
}
