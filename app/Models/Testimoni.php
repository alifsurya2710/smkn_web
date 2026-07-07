<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'pesan',
        'rating',
        'status',
    ];

    /**
     * Scope for approved testimonials.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Get average rating.
     */
    public static function averageRating()
    {
        return self::approved()->avg('rating') ?: 0;
    }
}
