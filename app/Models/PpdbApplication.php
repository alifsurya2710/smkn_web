<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'full_name',
        'nisn',
        'email',
        'phone',
        'first_choice_major_id',
        'second_choice_major_id',
        'status',
    ];

    public function firstChoice()
    {
        return $this->belongsTo(Major::class, 'first_choice_major_id');
    }

    public function secondChoice()
    {
        return $this->belongsTo(Major::class, 'second_choice_major_id');
    }
}
