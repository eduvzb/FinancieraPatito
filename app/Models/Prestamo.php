<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'cantidad',
        'num_pagos',
        'cuota',
        'pago_total',
        'fecha_ministracion',
        'fecha_vencimiento'
    ];
}
