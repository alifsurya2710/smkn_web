<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class YoutubeVideo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'youtube_id',
        'description',
        'order',
        'is_active',
        'thumbnail_url',
    ];
}
