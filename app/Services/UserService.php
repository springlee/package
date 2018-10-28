<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    protected $user;

    public function list($where)
    {
        $user = User::query()
            ->filter($where)
            ->where('enterprise_company_id','=',\Auth::user()->enterprise_company_id)
            ->where('user_type','=',User::TYPE_NORMAL)
            ->offset($where['offset'])->limit($where['limit'])->get()->each(function (
            $item,
            $key
        ) {

        });
        return [
            'rows' => $user->toArray(),
            'total' => User::query()->filter($where)->count()
        ];
    }
}
