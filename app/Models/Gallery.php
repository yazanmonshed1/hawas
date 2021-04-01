<?php

namespace App\Models;

use App\Models\ModelForms\GalleryForms;
use App\NadConsole\Models\Media;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use NadsoftModelBase, GalleryForms;

    protected $slug = 'galleries';

    public function media()
    {
        return $this->belongsToMany(Media::class, 'galleries_images', 'gallery_id', 'image_id');
    }

    public function hook_column_images_pre_render($item)
    {
        $count = $item ? $item->count() : null;
        return $count . ' ' . __('images');
    }
}
