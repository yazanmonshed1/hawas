<?php

namespace App\Models;

use App\Models\ModelForms\SliderForms;
use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use NadsoftModelBase, SliderForms;

    protected $slug = 'sliders';

    public function hook_column_description_pre_render($item)
    {
        if ((strlen($item) > 60)) {
            return mb_substr($item, 0, 60) . '...';
        }
        return $item;
    }

    public function hook_column_image_pre_render($item)
    {
        $extArr = explode('.', $item);
        $video = in_array(end($extArr), ['mp4', 'avi', 'webm', 'flv']) ? true : false;
        return $video == 'video' ? __('Video') . '<i class="fa fa-play px-3">' : '<img style="max-height: 80px" src="' . asset('storage/' . $item) . '" />';
    }
}
