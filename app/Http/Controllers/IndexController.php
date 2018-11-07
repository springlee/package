<?php

namespace App\Http\Controllers;




use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(Request $request )
    {
        $role_info ='';
        foreach ($request->user()->getRoleNames() as $roleName){
            $role_info .=  __($roleName).',';
        }
        $role_info =  trim( $role_info,',');
        return view('index.index',compact('role_info'));
    }

    public function main()
    {
        $enterprise_company_id= \Auth::user()->enterprise_company_id;
        $data['user_count'] = User::query()
            ->where('enterprise_company_id',$enterprise_company_id)->count();
        $data['package_total_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->count();
        $data['package_total_urgent_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('type',Package::TYPE_URGENT)
            ->count();
        $data['package_total_immediately_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('type',Package::TYPE_IMMEDIATELY)
            ->count();

        $data['package_today_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->count();
        $data['package_today_urgent_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->where('type',Package::TYPE_URGENT)
            ->count();

        $data['package_today_immediately_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->where('type',Package::TYPE_IMMEDIATELY)
            ->count();

        $data['package_today_un_deal_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->where('status','=',Package::STATUS_NEW)
            ->count();

        $data['package_today_un_deal_urgent_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->where('status','=',Package::STATUS_NEW)
            ->where('type',Package::TYPE_URGENT)
            ->count();

        $data['package_today_un_deal_immediately_count'] = Package::query()
            ->where('enterprise_company_id',$enterprise_company_id)
            ->where('created_at','>', Carbon::now()->format('Y-m-d'))
            ->where('status','=',Package::STATUS_NEW)
            ->where('type',Package::TYPE_IMMEDIATELY)
            ->count();

        //到期提醒
        $products = \Auth::user()->enterpriseCompany->products;







        return view('index.main',compact('data','products'));
    }


    public function changeLocale($locale)
    {
        if (in_array($locale, ['en', 'zh-CN'])) {
            session()->put('locale', $locale);
        }
        return redirect()
            ->back()
            ->withInput();
    }

}
