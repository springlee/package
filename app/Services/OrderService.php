<?php

namespace App\Services;

use App\Models\EnterpriseCompanyProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class OrderService
{


    public function list($where)
    {
        $order = Order::query()
            ->with(['product'])
            ->filter($where)
            ->where('enterprise_company_id','=',\Auth::user()->enterprise_company_id)
            ->where('status','=',Order::STATUS_FINISH)
            ->offset($where['offset'])->limit($where['limit'])->latest()->get()->each(function ($item, $key) {
                $item->product_info =  $item->product->product_name.'('. $item->num.Product::$unitMap[$item->product->unit].')';
        });
        return [
            'rows' => $order->toArray(),
            'total' => Order::query()->filter($where)
                ->where('enterprise_company_id','=',\Auth::user()->enterprise_company_id)
                ->where('status','=',Order::STATUS_FINISH)->count()
        ];
    }


}
