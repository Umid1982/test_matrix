<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrixProduct extends Model
{
    protected $table = 'matrix_products';

    protected $fillable = [
        'title',
        'sum',
        'status',
    ];

    public function tables()
    {
        return $this->hasMany(MatrixTable::class, 'id_product');
    }
}
