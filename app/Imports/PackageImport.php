<?php

namespace App\Imports;

use App\Exceptions\InvalidRequestException;
use App\Models\LogisticsCompany;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PackageImport implements ToCollection, WithBatchInserts, WithHeadingRow
{

    use Importable;

    public $header = [
        '物流单号',  '物流公司', '包裹类型','包裹数量', '备注'
    ];

    public $verifyHeader = true;

    public function collection(Collection $rows)
    {
        $insert = [];
        if(!$rows) throw new InvalidRequestException('表格没有数据');
        foreach ($rows as $key=>$row ){
            $data['logistics_tracking_number'] = array_get($row, '物流单号');
            $data['logistics_company_name'] = array_get($row, '物流公司');
            $data['package_type'] = array_get($row, '包裹类型');
            $data['package_quantity'] = array_get($row, '包裹数量');
            $data['remark'] = array_get($row, '备注');
            $validator = \Validator::make($data, [
                'logistics_tracking_number' => [
                    'required',
                    Rule::unique('packages')->where(function ($query) {
                        return $query->where('enterprise_company_id', \Auth::user()->enterprise_company_id);
                    })
                ],
                'logistics_company_name' => [
                    'required',
                    Rule::exists('logistics_companies')->where(function ($query) {
                        return $query->where('enterprise_company_id', \Auth::user()->enterprise_company_id);
                    })
                ],
                'package_type' => ['required', Rule::in(array_values(Package::$typeMap))],
                'package_quantity' => ['required', 'integer', 'min:1'],
            ]);
            if ($validator->fails()) {
                $line =$key+1;
                $error_msg = '';
                foreach ($validator->errors()->all() as $error) {
                    $error_msg .= '第'.$line .'行 ' .$error;
                }
                throw new InvalidRequestException($error_msg);
            }
            $logisticsCompany = LogisticsCompany::query()
                ->where('logistics_company_name','=',$data['logistics_company_name'])
                ->where('enterprise_company_id','=', \Auth::user()->enterprise_company_id)
                ->first();
            if($logisticsCompany->status===LogisticsCompany::STATUS_DISABLE){
                throw new InvalidRequestException($data['logistics_company_name'].'物流公司被禁用');
            }
            $insert[] = [
                'logistics_tracking_number' => $data['logistics_tracking_number'],
                'package_quantity' => $data['package_quantity'],
                'type' => array_search($data['package_type'],Package::$typeMap),
                'logistics_company_id'=>$logisticsCompany->id,
                'enterprise_company_id'=> \Auth::user()->enterprise_company_id,
                'create_user_id'=>\Auth::user()->id,
                'status'=>Package::STATUS_NEW,
                'mark_sure' => Package::MARK_SURE_NEW,
                'remark'=>$data['remark'],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ];
        }
        \DB::table('packages')->insert($insert);
    }


    public function batchSize(): int
    {
        return 1000;
    }

}
