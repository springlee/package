<?php

namespace App\Http\Requests;

use App\Models\Package;
use Illuminate\Validation\Rule;

class PackageRequest extends Request
{

    public function rules()
    {
        return [
           'logistics_tracking_number'=>['required',
               Rule::unique('packages')->where(function ($query){
                   $id =$this->route('package')->id??0;
                   if($id){
                       $query->where('id','!=',$id);
                   }
                   return $query->where('enterprise_company_id',$this->user()->enterprise_company_id);
               })
           ],
            'logistics_company_id'=>['required',
                Rule::exists('logistics_companies','id')->where(function ($query) {
                    return $query->where('enterprise_company_id', \Auth::user()->enterprise_company_id);
                })],
            'type'=>['required', Rule::in(array_keys(Package::$typeMap))],
            'package_quantity'=>['required', 'integer', 'min:1'],
        ];
    }
    public function attributes()
    {
        return [
            'logistics_tracking_number' =>'物流单号',
            'logistics_company_id'=>'物流公司',
            'type'=>'包裹类型',
            'package_quantity'=>'包裹数量'
        ];
    }
}
