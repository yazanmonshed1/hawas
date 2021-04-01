<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    protected $fillable = ['video_id', 'video_title', 'thumbnail', 'show'];
}
