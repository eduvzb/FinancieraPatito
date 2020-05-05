<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = 
    ['client_id',
     'prestamos_id',
     'cantidad'       
    ];
}
