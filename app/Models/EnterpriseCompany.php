<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnterpriseCompany extends Model
{
    //
    protected $fillable = [
        'enterprise_company_name',
    ];

    public function logisticsCompanies(){
        return $this->hasMany(LogisticsCompany::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }


    public function products(){
        return $this->belongsToMany(Product::class,'enterprise_company_products')->withPivot('expiry_date');
    }
}
