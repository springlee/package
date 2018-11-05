<?php
 namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
    public function createdAt($value){
        return $this->whereBetween('created_at',explode(' - ',$value));
    }

    public function orderSn($value){
        return $this->where('order_sn',$value);
    }
    public function transaction($value){
        return $this->where('transaction_id',$value);
    }
}
