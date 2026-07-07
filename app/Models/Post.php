<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes; //, \Spatie\Activitylog\Traits\LogsActivity;

    /*
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['title', 'content', 'category'])
            ->logOnlyDirty();
    }
    */

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category',
        'author_id',
        'major_id',
        'quote',
        'quote_author',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2000';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
