<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiCategory extends Model
{
    use HasFactory;

    protected $table = 'prestasi_categories';

    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'category_id');
    }
}
