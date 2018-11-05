<?php

namespace App\Services;

use App\Models\LogisticsCompany;

class LogisticsCompanyService
{

    protected $logisticsCompany;

    public function list($where)
    {
        $where['enterprise_company_id'] = \Auth::user()->enterprise_company_id;
        $logisticsCompany = LogisticsCompany::query()->filter($where)->offset($where['offset'])->limit($where['limit'])->latest()->get();
        return [
            'rows' => $logisticsCompany->toArray(),
            'total' => LogisticsCompany::query()->filter($where)->count()
        ];
    }
}
