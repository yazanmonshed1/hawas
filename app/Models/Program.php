<?php

namespace App\Models;

use App\Models\ModelForms\ProgramForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;
use App\NadConsole\Models\Media;
use Cviebrock\EloquentSluggable\Sluggable;

class Program extends Model
{
    use NadsoftModelBase, ProgramForms, Sluggable;

    protected $slug = 'programs';

    public function media()
    {
        return $this->belongsToMany(Media::class, 'program_media', 'program_id', 'media_id');
    }

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
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
                'source' => 'name'
            ]
        ];
    }
}
