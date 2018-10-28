<?php

namespace App\Services;

use App\Models\LogisticsCompany;

class LogisticsCompanyService
{

    protected $logisticsCompany;


    public function enable(LogisticsCompany $logisticsCompany)
    {
        $logisticsCompany->delete();
    }

    public function disable(LogisticsCompany $logisticsCompany)
    {
        $logisticsCompany->delete();
    }

    public function list($where)
    {
        $logisticsCompany = LogisticsCompany::query()->filter($where)->offset($where['offset'])->limit($where['limit'])->get()->each(function (
            $item,
            $key
        ) {
        });
        return [
            'rows' => $logisticsCompany->toArray(),
            'total' => LogisticsCompany::query()->filter($where)->count()
        ];
    }
    public function create(LogisticsCompany $logisticsCompany){

        $logisticsCompany->create();
    }
}
