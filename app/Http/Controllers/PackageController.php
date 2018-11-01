<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Services\PackageService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //

    public function merchandiserIndex()
    {
        $types = Package::$typeMap;
        $statuses = Package::$statusMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        return view('package.merchandiser_index', compact('types', 'statuses', 'logisticsCompanies'));
    }


    public function merchandiserList(Request $request, PackageService $packageService)
    {
        return response()->json($packageService->list($request->all()));
    }

    public function merchandiserCreate()
    {
        $types = Package::$typeMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        $package = new Package();
        return view('package.merchandiser_create_and_edit', compact('types', 'logisticsCompanies', 'package'));
    }

    public function merchandiserStore(PackageRequest $request, Package $package)
    {
        $package->fill($request->all());
        $package->enterprise_company_id = \Auth::user()->enterprise_company_id;
        $package->status = Package::STATUS_NEW;
        $package->create_user_id = \Auth::user()->id;
        $package->save();
        return response()->json(['success' => true, 'message' => '新增成功']);
    }

    public function merchandiserEdit(Package $package)
    {
        $types = Package::$typeMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        return view('package.merchandiser_create_and_edit', compact('types', 'logisticsCompanies', 'package'));
    }

    public function merchandiserUpdate(PackageRequest $request, Package $package)
    {
        $package->fill($request->all());
        $package->create_user_id = \Auth::user()->id;
        $package->save();
        return response()->json(['success' => true, 'message' => '修改成功']);
    }


    public function logistics(Package $package)
    {

        $url = "http://www.kuaidi100.com/applyurl?key=2e8c3920fe6c7767&com=".($package->logisticsCompany->logistics_company_code)."&nu=".$package->logistics_tracking_number;
        $http = new Client();
        $data = $http->get($url)->getBody()->getContents();
        if($data){
            return response()->json(['success' => true, 'message' => '请求成功','url'=>$data]);
        }else{
            return response()->json(['success' => false, 'message' => '请求失败']);
        }

    }


    public function active(Request $request, User $user)
    {
        $user->status = $request->checked === 'true' ? User::STATUS_ENABLE : User::STATUS_DISABLE;
        $user->save();
        return response()->json(['success' => true, 'message' => __('Deal with success')]);
    }

    public function forbidden(Request $request)
    {
        if ($request->user()->status === User::STATUS_ENABLE) {
            return redirect('/');
        }
        return view('user.disable');
    }
}
