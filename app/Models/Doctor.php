<?php

namespace App\Models;

use App\Models\Appointment;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{

    use Translatable, HasApiTokens, HasFactory, Notifiable;

    public $translatedAttributes = ['name', 'appointments'];

    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'number_of_statements', 'name', 'section_id', 'status',];
    //protected $guarded=[];

    /**
     * Get the Doctor's image.
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // One To One get section of Doctor
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_doctor');
    }
}