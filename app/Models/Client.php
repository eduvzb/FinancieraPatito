<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $guarded = []; //Permite guardar datos de forma masiva

    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }

  /*   public function delete ()
    {
        dd($this);
        foreach ($this->loans as $loan){
            foreach($loan->payments as $payment){
                $payment->delete();
            }
            $loan->delete();
        }
        return $this->delete();
    } */
}
