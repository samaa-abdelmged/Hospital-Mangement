<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Translatable;
    protected $translatedAttributes = ['name', 'Address'];
    protected $fillable = [
        'email',
        'password',
        'Date_Birth',
        'Phone',
        'Gender',
        'Blood_Group',
        'patient_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Invoice::class, 'doctor_id');
    }

    public function service()
    {
        return $this->belongsTo(Invoice::class, 'Service_id');
    }
}