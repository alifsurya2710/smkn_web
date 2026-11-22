<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'user_id',
        'full_name',
        'parent_name',
        'nisn',
        'email',
        'phone',
        'jalur_pendaftaran',
        'nominal_biaya',
        'pernah_paud',
        'foto_kk',
        'foto_akta',
        'foto_rapot_paud',
        'bukti_transfer',
        'first_choice_major_id',
        'second_choice_major_id',
        'status',
        'catatan',
    ];

    protected $casts = [
        'pernah_paud' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
