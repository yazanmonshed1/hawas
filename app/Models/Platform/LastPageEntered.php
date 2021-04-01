<?php

namespace App\Models\Platform;

use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use Illuminate\Database\Eloquent\Model;

class LastPageEntered extends Model
{
    protected $fillable = ['user_id', 'book_id', 'book_content_id'];

    public function book()
    {
        return $this->belongsTo(DigitalBook::class, 'book_id', 'id');
    }

    public function bookContent()
    {
        return $this->belongsTo(BookContent::class, 'book_content_id', 'id');
    }
}
