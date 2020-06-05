<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //Permite guardar datos de forma masiva, se usar para guardar datos desde excel
    protected $guarded = [];

    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }

}
