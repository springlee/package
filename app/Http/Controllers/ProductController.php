<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogisticsCompanyRequest;
use App\Models\LogisticsCompany;
use App\Models\Product;
use App\Services\LogisticsCompanyService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::all();
        $enterpriseCompanyProducts = \Auth::user()->enterpriseCompany->products->toArray()??[];
        $temp_key = array_column($enterpriseCompanyProducts,'id');
        $enterpriseCompanyProducts = array_combine($temp_key,$enterpriseCompanyProducts) ;
        return view('product.index',compact('products','enterpriseCompanyProducts'));
    }


    public function rules(Product $product){
        return view('product.rule',compact('product'));
    }


    public function pay(){

        //创建订单
        //调用支付宝



    }

    public function  payValid(){


    }

}
