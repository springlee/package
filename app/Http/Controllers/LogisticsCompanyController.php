<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogisticsCompanyRequest;
use App\Models\LogisticsCompany;
use App\Services\LogisticsCompanyService;
use Illuminate\Http\Request;

class LogisticsCompanyController extends Controller
{
    //

    public function index()
    {
        return view('logistics_company.index');
    }

    public function list(Request $request, LogisticsCompanyService $logisticsCompanyService)
    {
        return response()->json($logisticsCompanyService->list($request->all()));
    }

    public function create()
    {
        return view('logistics_company.create_and_edit', ['logisticsCompany' => new LogisticsCompany()]);
    }

    public function store(LogisticsCompanyRequest $request,LogisticsCompany $logisticsCompany)
    {
        $logisticsCompany->logistics_company_name = $request->logistics_company_name;
        $logisticsCompany->enterprise_company_id =  $request->user()->enterprise_company_id;
        $logisticsCompany->status = LogisticsCompany::STATUS_ENABLE;
        $logisticsCompany->create_user_id = $request->user()->id;
        $logisticsCompany->save();
        return response()->json(['success' => true, 'message' => '新增成功']);
    }

    public function edit(LogisticsCompany $logisticsCompany)
    {
        return view('logistics_company.create_and_edit', ['logisticsCompany' => $logisticsCompany]);
    }

    public function update(LogisticsCompanyRequest $request, LogisticsCompany $logisticsCompany)
    {
        $logisticsCompany->update($request->only([
            'logistics_company_name',
        ]));
        return response()->json(['success' => true, 'message' => '修改成功']);
    }


    public function active(Request $request, LogisticsCompany $logisticsCompany)
    {
        $logisticsCompany->status = $request->checked==='true'?LogisticsCompany::STATUS_ENABLE:LogisticsCompany::STATUS_DISABLE ;
        $logisticsCompany->save();
        return response()->json(['success' => true, 'message' =>  __('Deal with success')]);
    }
}
