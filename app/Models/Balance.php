<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = ['name'];

    public function userBalances()
    {
        return $this->hasMany(UserBalance::class, 'id_balance');
    }
}
