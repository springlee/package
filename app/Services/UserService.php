<?php

namespace App\Services;

use App\Models\EnterpriseCompanyProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class UserService
{

    protected $user;

    public function list($where)
    {
        $user = User::query()
            ->filter($where)
            ->where('enterprise_company_id','=',\Auth::user()->enterprise_company_id)
            ->where('user_type','=',User::TYPE_NORMAL)
            ->offset($where['offset'])->limit($where['limit'])->latest()->get()->each(function ($item, $key) {
                foreach ($item->getRoleNames() as $roleName){
                    $item->role_info .=  __($roleName).',';
                }
                $item->role_info =  trim( $item->role_info,',');

                $permissions = $item->getAllPermissions();
                foreach ($permissions as $permission){
                    $item->permission_info .=  __($permission->name).',';
                }
                $item->permission_info =  trim( $item->permission_info,',');
        });
        return [
            'rows' => $user->toArray(),
            'total' => User::query()->filter($where)
                ->where('enterprise_company_id','=',\Auth::user()->enterprise_company_id)
                ->where('user_type','=',User::TYPE_NORMAL)->count()
        ];
    }

    public function enterpriseCompanyServiceByRegisterOrAdd(User $user){

        $delay = 6 ;
        $product = Product::query()->where('product_code','=','system')->first();
        $enterProduct = EnterpriseCompanyProduct::create([
            'product_id'=>$product->id,
            'enterprise_company_id'=>$user->enterprise_company_id,
            'expire_date'=>Carbon::now(),
        ]);
        $expiry_date = Carbon::now()->addMonth($delay);
        $enterProduct->expiry_date = $expiry_date;
        $enterProduct->save();
        User::query()
            ->where('enterprise_company_id', $user->enterprise_company_id)
            ->update(['expiry_date'=>$expiry_date]);
        $order = new Order();
        $order = $order->fill([
            'enterprise_company_id' => $user->enterprise_company_id,
            'product_id' => $product->id,
            'num' =>$delay,
            'money' => 0,
            'status' => Order::STATUS_FINISH,
            'remark'=>'系统服务赠送'.$delay.Product::$unitMap[$product->unit].' 到期日:'.$expiry_date->format('Y-m-d'),
        ]);
        $order->save();

        //初始化物流公司
        $this->initLogisticsEnterpriseCompanyCompanyService($user);
    }

    public function initLogisticsEnterpriseCompanyCompanyService($user){

        if(!count($user->enterpriseCompany->logisticsCompanies)){
            $arrList = [
                [
                    'logistics_company_name'=>'邮政EMS',
                    'logistics_company_code'=>'ems',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'申通快递',
                    'logistics_company_code'=>'shentong',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'中通速递',
                    'logistics_company_code'=>'zhongtong',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'圆通速递',
                    'logistics_company_code'=>'yuantong',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'顺丰快递',
                    'logistics_company_code'=>'shunfeng',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'亚风快递',
                    'logistics_company_code'=>'yafengsudi',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'天天快递',
                    'logistics_company_code'=>'tiantian',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'DHL快递',
                    'logistics_company_code'=>'dhl',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'韵达货运',
                    'logistics_company_code'=>'yunda',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
                [
                    'logistics_company_name'=>'百世汇通',
                    'logistics_company_code'=>'huitongkuaidi',
                    'enterprise_company_id'=>$user->enterprise_company_id,
                    'create_user_id'=>$user->id,
                    'status'=>'enable',
                    'created_at'=>Carbon::now()
                ],
            ];
            \DB::table('logistics_companies')->insert($arrList);
        }
    }
}
