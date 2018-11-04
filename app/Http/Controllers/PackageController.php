<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Exports\PackageExport;
use App\Http\Requests\PackageRequest;
use App\Imports\PackageImport;
use App\Imports\PackageReceiveImport;
use App\Models\LogisticsCompany;
use App\Models\Package;
use App\Services\PackageService;
use Carbon\Carbon;
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
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies()->where('status',LogisticsCompany::STATUS_ENABLE)->get();
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
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies()->where('status',LogisticsCompany::STATUS_ENABLE)->get();
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

        $url = "http://www.kuaidi100.com/applyurl?key=2e8c3920fe6c7767&com=" . ($package->logisticsCompany->logistics_company_code) . "&nu=" . $package->logistics_tracking_number;
        $http = new Client();
        $data = $http->get($url)->getBody()->getContents();
        if ($data) {
            return response()->json(['success' => true, 'message' => '请求成功', 'url' => $data]);
        } else {
            return response()->json(['success' => false, 'message' => '请求失败']);
        }
    }

    public function download(Request $request)
    {
        $filename = '包裹信息-' . date('YmdHis') . '.xlsx';
        $where = $request->all();
        $where['enterprise_company_id'] = \Auth::user()->enterprise_company_id;
        (new PackageExport($where))->store($filename, 'public');
        return response()->json(['success' => true, 'message' => '下载成功', 'url' => url('/storage/') . '/' . $filename]);
    }


    public function merchandiserImport()
    {
        return view('package.merchandiser_import');
    }

    public function merchandiserImportSave(Request $request)
    {
        try {

            $file = $request->file('xlsx');
            //校验文件
            if (isset($file) && $file->isValid()) {
                $ext = $file->getClientOriginalExtension(); //上传文件的后缀
                //判断是否是Excel
                if (empty($ext) or in_array(strtolower($ext), ['xlsx']) === false) {
                    throw new InvalidRequestException('不允许的文件类型');
                }
            } else {
                throw new InvalidRequestException('文件非法');
            }
            \DB::transaction(function () use ($file) {
                (new PackageImport())->import($file);
            });
            echo '<script type="text/javascript" language="javascript">';
            echo 'parent.importSuccess();';
            echo 'var index = parent.layer.getFrameIndex(window.name);';
            echo 'parent.layer.close(index);';
            echo '</script>';
            exit;
        } catch (\Exception $exception) {
            echo '<script type="text/javascript" language="javascript">';
            echo 'parent.toastr.error("' . $exception->getMessage() . '");';
            echo '</script>';
        }
        return view('package.merchandiser_import');
    }


    public function warehousemanIndex()
    {
        $types = Package::$typeMap;
        $statuses = Package::$statusMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        return view('package.warehouseman_index', compact('types', 'statuses', 'logisticsCompanies'));
    }


    public function warehousemanList(Request $request, PackageService $packageService)
    {
        return response()->json($packageService->list($request->all()));
    }


    public function warehousemanReceive(Package $package){
        $types = Package::$typeMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        return view('package.warehouseman_receive', compact('types', 'logisticsCompanies', 'package'));
    }
    public function warehousemanReceiveSave(Package $package ,Request $request){

        $this->validate($request, ['receive_quantity' => 'required|integer|min:1']);
        $package->receive_quantity = $request->receive_quantity;
        $package->received_at = Carbon::now();
        $package->receive_user_id = \Auth::user()->id;
        $package->status = Package::STATUS_FINISH;
        $package->save();
        return response()->json(['success' => true, 'message' => '签收成功']);
    }

    public function quickWarehousemanReceiveSave(){



    }


    public function warehousemanImport(){
        return view('package.warehouseman_import');
    }

    public function warehousemanImportSave(Request $request)
    {
        try {

            $file = $request->file('xlsx');
            //校验文件
            if (isset($file) && $file->isValid()) {
                $ext = $file->getClientOriginalExtension(); //上传文件的后缀
                //判断是否是Excel
                if (empty($ext) or in_array(strtolower($ext), ['xlsx']) === false) {
                    throw new InvalidRequestException('不允许的文件类型');
                }
            } else {
                throw new InvalidRequestException('文件非法');
            }
            \DB::transaction(function () use ($file) {
                (new PackageReceiveImport())->import($file);
            });
            echo '<script type="text/javascript" language="javascript">';
            echo 'parent.importSuccess();';
            echo 'var index = parent.layer.getFrameIndex(window.name);';
            echo 'parent.layer.close(index);';
            echo '</script>';
            exit;
        } catch (\Exception $exception) {
            echo '<script type="text/javascript" language="javascript">';
            echo 'parent.toastr.error("' . $exception->getMessage() . '");';
            echo '</script>';
        }
        return view('package.warehouseman_import');
    }


    public function reportIndex()
    {
        $types = Package::$typeMap;
        $statuses = Package::$statusMap;
        $logisticsCompanies = \Auth::user()->enterpriseCompany->logisticsCompanies;
        return view('package.report_index', compact('types', 'statuses', 'logisticsCompanies'));
    }


    public function reportList(Request $request, PackageService $packageService)
    {
        return response()->json($packageService->list($request->all()));
    }

}

