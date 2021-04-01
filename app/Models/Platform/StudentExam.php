<?php

namespace App\Models\Platform;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    protected $fillable = ['user_id', 'book_content_id'];

    public function suitableWordsAnswers()
    {
        return $this->hasMany(StudentSuitableWordsAnsweres::class, 'student_exam_id', 'id');
    }

    public function multipleChoiceAnswers()
    {
        return $this->hasMany(StudentMultipleChoiceAnswer::class, 'student_exam_id', 'id');
    }

    public function matchSentencesAnswers()
    {
        return $this->hasMany(StudentMatchWordsAnsweres::class, 'student_exam_id', 'id');
    }

    public function matchImagesAnswers()
    {
        return $this->hasMany(StudentMatchImagesAnswer::class, 'student_exam_id', 'id');
    }

    public function bookContent()
    {
        return $this->belongsTo(BookContent::class, 'book_content_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
