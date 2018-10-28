<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    const TYPE_MANGER = 'manger';
    const TYPE_NORMAL = 'normal';


    public static $typesMap = [
        self::TYPE_MANGER => '企业管理员',
        self::TYPE_NORMAL => '企业普通员',
    ];


    const STATUS_ENABLE = 'enable';
    const STATUS_DISABLE = 'disable';


    public static $statusMap = [
        self::STATUS_ENABLE => '启用中',
        self::STATUS_DISABLE => '禁用中',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','enterprise_company_id','expiry_date','local','user_type','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
