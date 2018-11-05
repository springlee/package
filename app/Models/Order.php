<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const STATUS_NEW = 'new';
    const STATUS_FINISH = 'finish';

    public static $statusMap = [
        self::STATUS_NEW => '未完成',
        self::STATUS_FINISH => '已完成',
    ];

    protected $fillable = [
        'order_sn',
        'enterprise_company_id',
        'product_id',
        'product_rule_id',
        'money',
        'status',
        'paid_at',
        'transaction_id',
        'remark',
    ];


    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('order_sn', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->order_sn) {
                // 调用 findAvailableNo 生成订单流水号
                $model->order_sn = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->order_sn) {
                    return false;
                }
            }
        });
    }

    public function rule(){
        return $this->belongsTo(ProductRule::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
