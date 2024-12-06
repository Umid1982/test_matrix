<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrixTable extends Model
{
    protected $table = 'matrix_tables';

    protected $fillable = [
        'id_user',
        'id_product',
        'sum',
        'percent',
        'user1',
        'user2',
        'user3',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(MatrixProduct::class, 'id_product');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2');
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'user3');
    }
}
