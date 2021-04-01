<?php

namespace App\Models;

use App\Models\ModelForms\PlayForms;
use App\NadConsole\Models\Media;
use App\NadConsole\Traits\NadsoftModelBase;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use NadsoftModelBase, PlayForms, Sluggable;

    protected $slug = 'plays';

    public function media()
    {
        return $this->belongsToMany(Media::class, 'plays_media', 'play_id', 'media_id');
    }

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
    }

    public function hook_column_header_image_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_image_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_images_pre_render($item)
    {
        $count = $item ? $item->count() : null;
        return $count . ' ' . __('images');
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
