<?php

namespace App\Models\Platform;

use App\Models\DigitalBook;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    protected $fillable = ['title'];

    public function book()
    {
        return $this->belongsTo(DigitalBook::class, 'book_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
    }

    public function multipleChoicesQuestions()
    {
        return $this->hasMany(MultipleChoice::class, 'book_content_id', 'id');
    }

    public function matchSentences()
    {
        return $this->hasMany(MatchWordToSentence::class, 'book_content_id', 'id');
    }

    public function matchImages()
    {
        return $this->hasMany(MatchImage::class, 'book_content_id', 'id');
    }
}
