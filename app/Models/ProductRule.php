<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRule extends Model
{
    //

    protected $fillable = [
        'product_id',
        'num',
        'price'
    ];
}
