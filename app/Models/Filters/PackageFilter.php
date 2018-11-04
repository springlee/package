<?php
 namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class PackageFilter extends ModelFilter
{
    public function createdAt($value){
        return $this->whereBetween('created_at',explode(' - ',$value));
    }

    public function logisticsTrackingNumber($value){
        return $this->whereLike('logistics_tracking_number',$value);
    }
    public function logisticsCompany($value){
        return $this->where('logistics_company_id',$value);
    }
    public function enterpriseCompany($value){
        return $this->where('enterprise_company_id',$value);
    }
    public function type($value){
        return $this->where('type',$value);
    }
    public function status($value){
        return $this->where('status',$value);
    }

    public function receiveUserName($value){
        return $this->whereHas('receiveUser',function ($query)use($value){
            $query->where('name','like','%'.$value.'%');
        });
    }

}
