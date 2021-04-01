<?php

namespace App\Models;

use App\Models\ModelForms\DigitalBookForms;
use App\Models\Platform\BookContent;
use App\Models\Platform\Chapter;
use App\NadConsole\Traits\NadsoftModelBase;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class DigitalBook extends Model
{
    use NadsoftModelBase, DigitalBookForms, Sluggable;

    protected $slug = 'digital_books';

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
    }

    public function hook_column_intro_pre_render($item)
    {
        return $this->media_type == 'video' ? __('Video') . '<i class="fa fa-play px-3">' : '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }


    public function hook_column_cover_image_pre_render($item)
    {
        return '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }

    public function hook_column_grade_pre_render($item)
    {
        return $item->name . ' - ' . $item->school->name;
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

    public function contents()
    {
        return $this->hasMany(BookContent::class, 'book_id', 'id')->where('table_name', '!=', 'multiple_choices');
    }

    public function allContents()
    {
        return $this->hasMany(BookContent::class, 'book_id', 'id');
    }

    public function multipleChoices()
    {
        return $this->hasMany(BookContent::class, 'book_id', 'id')->where('table_name', 'multiple_choices');
    }

    public function filterData()
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth('admin')->user();

        if ($admin->hasRole('secretary')) {
            return $this->where('school_id', $admin->school->id);
        }
        return $this;
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'digital_book_id', 'id');
    }
}
