<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{    
    protected $table = 'service_group'; 
    protected $guarded = [];
    use HasFactory;

}