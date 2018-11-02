<?php

namespace App\Services;

use App\Models\Package;

class PackageService
{

    protected $user;

    public function list($where)
    {
        $where['enterprise_company_id'] = \Auth::user()->enterprise_company_id;
        $package = Package::query()
            ->with('logisticsCompany')
            ->filter($where)
            ->offset($where['offset'])->limit($where['limit'])->get()->each(function ($item, $key) {
                $item->logistics_company_name = $item->logisticsCompany->logistics_company_name;
                $item->type_name = Package::$typeMap[$item->type];
                $item->status_name = Package::$statusMap[$item->status];
        });
        return [
            'rows' => $package->toArray(),
            'total' => Package::query()->filter($where)->count()
        ];
    }
}
