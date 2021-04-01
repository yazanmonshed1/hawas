<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class PaintImage extends Model
{
    public function colors()
    {
        return $this->hasMany(PaintImagesColor::class, 'paint_image_id', 'id');
    }
}
