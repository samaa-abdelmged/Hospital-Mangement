<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{

    protected $fillable = ['name'];
    public $timestamps = false;
    use HasFactory;

}