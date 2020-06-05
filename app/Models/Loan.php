<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'client_id',
        'amount',
        'payments_number',
        'fee',
        'ministry_date',
        'due_date',
        'finished'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function paymentsOrderBy()
    {
        return $this->hasMany('App\Models\Payment')->orderBy('id', 'asc');
    }


    public function getSaldoAbonadoAttribute()
    {
        return $this->payments()->sum('received_amount');
    }

    public function getSaldoPendienteAttribute()
    {
        $saldoPendiente = $this->payments()->sum('amount') - $this->saldoAbonado;
        return $saldoPendiente;
    }

    public function getPagosCompletadosAttribute()
    {
        return $this->payments()->where('paid',1)->count();   
    }

    
}
