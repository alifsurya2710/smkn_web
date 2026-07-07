<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        $today = now()->toDateString();
        return $query->where('is_active', true)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today);
    }
}
