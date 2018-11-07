<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserRequest extends Request
{

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('users')->where(function ($query) {
                    $id = $this->route('user')->id ?? 0;
                    if ($id) {
                        $query->where('id', '!=', $id);
                    }
                    return $query;
                })
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    $id = $this->route('user')->id ?? 0;
                    if ($id) {
                        $query->where('id', '!=', $id);
                    }
                    return $query;
                })
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            "roles"=>['required','array','exists:roles,name']
        ];
    }

    public function attributes()
    {
        return [
            'logistics_company_name' => __('Logistics Company'),
            'roles'=>'角色',
            'email'=>'邮箱(本系统中)',
            ];
    }
}
