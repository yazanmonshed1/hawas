<?php

namespace App\Models;

use App\Models\ModelForms\CollapseForms;
use App\NadConsole\Models\Media;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Collapse extends Model
{
    use NadsoftModelBase, CollapseForms;

    protected $slug = 'collapses';

    public function media()
    {
        return $this->belongsToMany(Media::class, 'collapses_images', 'collapse_id', 'media_id')->where('for', 'about_us');
    }

    public function part()
    {
        return $this->belongsTo(TextBookPart::class, 'text_book_part_id', 'id');
    }

    public function hook_column_images_pre_render($item)
    {
        return $item->count() . ' صور';
    }

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
    }
}
