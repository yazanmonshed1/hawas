<?php

namespace App\Models;

use App\Models\ModelForms\TextBookPartForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class TextBookPart extends Model
{
    use NadsoftModelBase, TextBookPartForms;

    protected $slug = 'text_book_parts';

    protected $fillable = ['title', 'text_book_id'];

    public function collapses()
    {
        return $this->hasMany(Collapse::class, 'text_book_part_id', 'id');
    }

    public function book() {
        return $this->belongsTo(TextBook::class, 'text_book_id', 'id');
    }
}
