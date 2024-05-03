<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}