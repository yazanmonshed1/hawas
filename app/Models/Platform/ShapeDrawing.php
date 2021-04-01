<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class ShapeDrawing extends Model
{
    public function colors()
    {
        return $this->hasMany(ShapeDrawingColor::class, 'shape_drawing_id', 'id');
    }
}
