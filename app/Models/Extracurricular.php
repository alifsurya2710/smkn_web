<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'mentor',
        'coach',
        'schedule',
        'is_active',
        'order',
        'about_title',
        'about_description',
        'about_image',
        'footer_description',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image ? asset('storage/' . $this->image) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }
}
