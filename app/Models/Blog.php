<?php

namespace App\Models;

use App\Models\ModelForms\BlogForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use NadsoftModelBase, BlogForms, Sluggable;

    protected $slug = 'blogs';

    public function hook_column_image_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_brief_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
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
