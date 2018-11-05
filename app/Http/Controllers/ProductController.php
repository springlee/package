<?php

namespace App\Http\Controllers;

use App\Models\EnterpriseCompanyProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductRule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::all();
        $enterpriseCompanyProducts = \Auth::user()->enterpriseCompany->products->toArray() ?? [];
        $temp_key = array_column($enterpriseCompanyProducts, 'id');
        $enterpriseCompanyProducts = array_combine($temp_key, $enterpriseCompanyProducts);
        return view('product.index', compact('products', 'enterpriseCompanyProducts'));
    }


    public function rules(Product $product)
    {
        return view('product.rule', compact('product'));
    }


    public function pay(Product $product, Order $order, Request $request)
    {

        $rule = ProductRule::findOrfail($request->input('rule_id'));
        //创建订单
        $order = $order->fill([
            'enterprise_company_id' => \Auth::user()->enterprise_company_id,
            'product_id' => $product->id,
            'product_rule_id' => $rule->id,
            'money' => $rule->price,
            'status' => Order::STATUS_NEW,
        ]);
        $order->save();
        //调用支付宝
        // 调用支付宝的网页支付
        return app('alipay')->web([
            'out_trade_no' => $order->order_sn, // 订单编号，需保证在商户端不重复
            'total_amount' => $rule->price, // 订单金额，单位元，支持小数点后两位
            'subject' => '支付  包裹订单 的订单：' . $order->order_sn, // 订单标题
        ]);


    }

    public function payValid()
    {
        // 校验输入参数
        $data = app('alipay')->verify();
        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = Order::where('order_sn', $data->out_trade_no)->first();
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态已经是已支付
        if ($order->paid_at) {
            // 返回数据给支付宝
            return app('alipay')->success();
        }
        \DB::transaction(function () use ($order, $data) {
            //判断企业有没有此产品
            $enterProduct = EnterpriseCompanyProduct::query()
                ->where('product_id', $order->enterprise_company_id)
                ->where('enterprise_company_id', $order->enterprise_company_id)
                ->first();
            switch ($order->product->unit) {
                case 'month':
                    $delay = 1 * $order->rule->num;
                    break;
                case 'quarter':
                    $delay = 3 * $order->rule->num;
                    break;
                default:
                    $delay = 1 * $order->rule->num;
                    break;
            }
            if ($enterProduct) {
                if (Carbon::now()->diffInDays($enterProduct->expiry_date) > 0) {
                    $source_date = Carbon::now();
                    $expiry_date = Carbon::now()->addMonth($delay);
                } else {
                    $source_date = $enterProduct->expiry_date;
                    $expiry_date = $enterProduct->expiry_date->addMonth($delay);
                }
            } else {
                $enterProduct = EnterpriseCompanyProduct::create([
                    'product_id' => $order->product_id,
                    'enterprise_company_id' => $order->enterprise_company_id,
                    'expire_date' => Carbon::now(),
                ]);
                $source_date = Carbon::now();
                $expiry_date = Carbon::now()->addMonth($delay);
            }
            $enterProduct->expiry_date = $expiry_date;
            $enterProduct->save();
            User::query()
                ->where('enterprise_company_id', $order->enterprise_company_id)
                ->update(['expiry_date' => $expiry_date]);

            $order->update([
                'paid_at' => Carbon::now(), // 支付时间
                'transaction_id' => $data->trade_no, // 支付宝订单号
                'status' => Order::STATUS_FINISH,
                'remark' => '原到期日:' . $expiry_date . ',当前到期日:' . $source_date,
            ]);
        });
        return app('alipay')->success();
    }

}
