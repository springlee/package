<?php
 namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class LogisticsCompanyFilter extends ModelFilter
{
    public function createdAt($value){
        return $this->whereBetween('created_at',explode(' - ',$value));
    }

    public function logisticsCompanyName($value){
        return $this->whereLike('logistics_company_name',$value);
    }
    public function enterpriseCompany($value){
        return $this->where('enterprise_company_id',$value);
    }
}
