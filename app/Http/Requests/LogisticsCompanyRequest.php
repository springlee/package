<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class LogisticsCompanyRequest extends Request
{

    public function rules()
    {
        return [
           'logistics_company_name'=>['required',
               Rule::unique('logistics_companies')->where(function ($query){
                   $id =$this->route('logistics_company')->id??0;
                   if($id){
                       $query->where('id','!=',$id);
                   }
                   return $query->where('enterprise_company_id',\Auth::user()->enterprise_company_id);
               })
           ],
           'logistics_company_code'=>['required'],
        ];
    }
    public function attributes()
    {
        return [
            'logistics_company_name' =>__('Logistics Company')
        ];
    }
}
