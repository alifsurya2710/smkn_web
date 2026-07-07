<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'category',
        'extracurricular_id',
        'major_id',
        'is_featured',
    ];

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function photos()
    {
        return $this->hasMany(Gallery::class);
    }
}
