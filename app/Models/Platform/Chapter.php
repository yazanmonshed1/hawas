<?php

namespace App\Models\Platform;

use App\Models\DigitalBook;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function digitalBook()
    {
        return $this->belongsTo(DigitalBook::class, 'digital_book_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(BookContent::class, 'chapter_id', 'id')->where('table_name', '!=', 'multiple_choices');
    }

    public function multipleChoices()
    {
        return $this->hasMany(BookContent::class, 'chapter_id', 'id')->where('table_name', '=', 'multiple_choices');
    }

    public function allContents()
    {
        return $this->hasMany(BookContent::class, 'chapter_id', 'id');
    }
}
