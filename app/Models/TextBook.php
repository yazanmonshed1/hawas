<?php

namespace App\Models;

use App\Models\ModelForms\TextBookForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class TextBook extends Model
{
    use NadsoftModelBase, TextBookForms, Sluggable;

    protected $slug = 'text_books';

    public function parts()
    {
        return $this->hasMany(TextBookPart::class, 'text_book_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(TextBookPart::class, 'text_book_text_book_parts', 'text_book_id', 'text_book_part_id');
    }

    public function text_book_part()
    {
        return $this->hasMany(TextBookPart::class, 'text_book_id', 'id');
    }

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
    }

    public function hook_column_back_cover_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_front_cover_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
