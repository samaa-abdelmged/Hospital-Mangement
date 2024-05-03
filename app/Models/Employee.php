<?php
namespace App\Models;

use App\Models\LaboratorieEmployee;
use App\Models\RayEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'section',
        'ray_employee_id',
        'laboratorie_employee_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function RayEmployee()
    {
        return $this->belongsTo(RayEmployee::class, 'ray_employee_id');
    }

    public function LaboratorieEmployee()
    {
        return $this->belongsTo(LaboratorieEmployee::class, 'laboratorie_employee_id');
    }
}