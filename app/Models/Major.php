<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    /*
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description', 'head_of_major'])
            ->logOnlyDirty();
    }
    */

    protected $fillable = [
        'name',
        'acronym',
        'tagline',
        'category',
        'banner_text',
        'color',
        'seats',
        'slug',
        'image',
        'about_image',
        'video_url',
        'description',
        'detailed_description',
        'head_of_major',
        'teachers',
        'curriculum',
        'career_opportunities',
        'gallery',
        'highlight_title',
        'highlight_description',
        'highlight_icon',
        'secondary_color',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'teachers' => 'array',
        'gallery' => 'array',
        'curriculum' => 'array',
        'career_opportunities' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'major_user');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'major_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
