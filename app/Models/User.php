<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, \Illuminate\Database\Eloquent\SoftDeletes; //, \Spatie\Activitylog\Traits\LogsActivity;

    /*
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'email', 'nisn', 'major_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn',
        'no_telp',
        'major_id',
        'title',
        'nip',
        'rank',
        'position',
        'subject',
        'photo',
        'is_management',
        'order',
        'social_id',
        'social_type',
        'social_token',
        'social_refresh_token',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'major_user');
    }

    public function reports()
    {
        return $this->hasMany(StudentReport::class, 'student_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
