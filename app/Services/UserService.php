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
            ->offset($where['offset'])->limit($where['limit'])->get()->each(function ($item, $key) {
                foreach ($item->getRoleNames() as $roleName){
                    $item->role_info .=  __($roleName).',';
                }
                $item->role_info =  trim( $item->role_info,',');

                $permissions = $item->getAllPermissions();
                foreach ($permissions as $permission){
                    $item->permission_info .=  __($permission->name).',';
                }
                $item->permission_info =  trim( $item->permission_info,',');
        });
        return [
            'rows' => $user->toArray(),
            'total' => User::query()->filter($where)->count()
        ];
    }
}
