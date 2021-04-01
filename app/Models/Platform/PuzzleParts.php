<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class PuzzleParts extends Model
{
    protected $fillable = ['number'];
    
    public function puzzle()
    {
        return $this->belongsTo(Puzzle::class, 'puzzle_id', 'id');
    }
}
