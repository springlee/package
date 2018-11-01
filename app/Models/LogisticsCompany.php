<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
class LogisticsCompany extends Model
{
    use Filterable;

    const STATUS_ENABLE = 'enable';
    const STATUS_DISABLE = 'disable';


    public static $statusMap = [
        self::STATUS_ENABLE => '启用中',
        self::STATUS_DISABLE => '禁用中',
    ];
    protected $fillable = [
        'logistics_company_name',
        'logistics_company_code',
        'enterprise_company_id',
        'create_user_id',
        'status'
    ];



}
