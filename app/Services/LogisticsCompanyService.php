<?php

namespace App\Services;

use App\Models\LogisticsCompany;

class LogisticsCompanyService
{

    protected $logisticsCompany;

    public function list($where)
    {
        $logisticsCompany = LogisticsCompany::query()->filter($where)->offset($where['offset'])->limit($where['limit'])->get();
        return [
            'rows' => $logisticsCompany->toArray(),
            'total' => LogisticsCompany::query()->filter($where)->count()
        ];
    }
}
