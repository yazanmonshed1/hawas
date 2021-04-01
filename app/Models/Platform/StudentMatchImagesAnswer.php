<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class StudentMatchImagesAnswer extends Model
{
    public function matchImage()
    {
        return $this->belongsTo(MatchImage::class, 'question_id', 'id');
    }
}
