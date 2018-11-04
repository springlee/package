<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    const UNIT_MONTH = 'month';
    const UNIT_QUARTER = 'quarter';

    protected $fillable = [
        'product_code',
        'product_name',
        'product_desc',
        'unit',
    ];

    public static $unitMap =[
        self::UNIT_MONTH=>'月',
        self::UNIT_QUARTER=>'季度'
    ];

    public  function rules(){

        return $this->hasMany(ProductRule::class);
    }
}
