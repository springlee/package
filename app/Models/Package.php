<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
class Package extends Model
{
    use Filterable;

    const STATUS_NEW = 'new';
    const STATUS_FINISH = 'finish';

    const TYPE_NORMAL = 'normal';
    const TYPE_URGENT = 'urgent';
    const TYPE_IMMEDIATELY='immediately';



    public static $statusMap = [
        self::STATUS_NEW => '未完成',
        self::STATUS_FINISH => '已完成',
    ];
    public static $typeMap = [
        self::TYPE_NORMAL => '普通件',
        self::TYPE_URGENT => '紧急件',
        self::TYPE_IMMEDIATELY => '立刻处理件',
    ];

    protected $fillable = [
        'logistics_tracking_number',
        'logistics_company_id',
        'enterprise_company_id',
        'package_quantity',
        'type',
        'status',
        'create_user_id',
        'receive_user_id',
        'received_at',
        'mark_sure',
        'remark'
    ];

    public function logisticsCompany(){
        return $this->hasOne(LogisticsCompany::class,'id','logistics_company_id');
    }

    public function createUser(){

        return $this->hasOne(User::class,'id','create_user_id');
    }


    public function receiveUser(){
        return $this->hasOne(User::class,'id','receive_user_id');

    }

}
