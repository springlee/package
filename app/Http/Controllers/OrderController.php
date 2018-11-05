<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        return view('order.index');
    }

    public function list(OrderService $orderService ,Request $request){

        return response()->json($orderService->list($request->all()));
    }

}
