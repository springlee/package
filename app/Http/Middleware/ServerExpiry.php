<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ServerExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Carbon::now()->diffInDays($request->user()->expiry_date,false)<0){
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message'=>'你的账号系统服务已到期']);
            }else{
                return redirect('users/expiry');
            }
        }
        return $next($request);
    }
}
