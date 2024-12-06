<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    protected $fillable = ['id_user', 'id_balance', 'sum'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function balance()
    {
        return $this->belongsTo(Balance::class, 'id_balance'); // Предположим, что у вас есть модель Balance
    }
}
