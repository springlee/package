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
        return view('index.main',compact('data'));
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

    public function test(){
        $user = \Auth::user();
        $user->assignRole('Company colleagues');
        $user->givePermissionTo('package_info_input');
        var_dump($user->getPermissionsViaRoles()->toArray(),$user->getDirectPermissions()->toArray(),$user->getAllPermissions()->toArray());exit;
    }

}
