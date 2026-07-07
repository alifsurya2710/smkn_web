<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'extracurricular_id',
        'date',
        'year',
        'is_featured',
    ];

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class);
    }

    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PrestasiCategory::class, 'category_id');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1544650030-3c519eb3ad4d?q=80&w=2070&auto=format&fit=crop';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
