<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class Puzzle extends PlatformModelBase
{
    public function parts()
    {
        return $this->hasMany(PuzzleParts::class, 'puzzle_id', 'id');
    }
}
