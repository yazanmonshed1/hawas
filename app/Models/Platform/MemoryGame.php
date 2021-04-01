<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class MemoryGame extends Model
{
    //
    public function images()
    {
        return $this->hasMany(MemoryGameMedia::class, 'memory_games_media_id', 'id');
    }
}
