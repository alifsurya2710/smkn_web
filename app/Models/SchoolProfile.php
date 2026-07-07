<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'about_hero_title',
        'about_hero_description',
        'about_hero_image',
        'vision',
        'mission',
        'principal_name',
        'principal_title',
        'principal_message',
        'principal_photo',
        'history',
        'stats',
        'staff_hero_title',
        'staff_hero_description',
        'staff_hero_image',
    ];

    protected $casts = [
        'mission' => 'array',
        'history' => 'array',
        'stats' => 'array',
    ];
}
