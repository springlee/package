<?php
 namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function createdAt($value){
        return $this->whereBetween('created_at',explode(' - ',$value));
    }

    public function email($value){
        return $this->where('email',$value);
    }

    public function name($value){
        return $this->where('name',$value);
    }
}
