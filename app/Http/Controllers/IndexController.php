<?php

namespace App\Http\Controllers;




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

        return view('index.main');
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
