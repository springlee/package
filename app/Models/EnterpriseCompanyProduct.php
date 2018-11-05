<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnterpriseCompanyProduct extends Model
{
    //


    protected $fillable = [
        'product_id',
        'enterprise_company_id',
        'expiry_date'
    ];

    protected $casts = [
        'expiry_date'=>'date'
    ];
}
