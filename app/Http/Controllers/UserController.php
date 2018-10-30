<?php

namespace App\Http\Controllers;



use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function resetPasswordForm()
    {
        return view('user.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, ['password' => 'required|confirmed|min:6']);
        $user =$request->user();
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json(['success' => true, 'message' => __('Deal with success')]);
    }

    public function index()
    {
        return view('user.index');
    }

    public function list(Request $request, UserService $user)
    {
        return response()->json($user->list($request->all()));
    }

    public function create()
    {
        $roles = Role::query()->where('name','!=','Admin')->get();
        return view('user.create_and_edit', ['user' => new User(),'roles'=>$roles]);
    }

    public function store(UserRequest $request,User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($request->password);
        $user->status= User::STATUS_ENABLE;
        $user->user_type= User::TYPE_NORMAL;
        $user->enterprise_company_id= \Auth::user()->enterprise_company_id;
        $user->save();
        $user->assignRole($request->roles);
        return response()->json(['success' => true, 'message' => '新增成功']);
    }

    public function edit(User $user)
    {
        $roles = Role::query()->where('name','!=','Admin')->get();
        return view('user.create_and_edit', ['user' => $user,'roles'=>$roles]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password!='3ArAiVfZ'){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles($request->roles);
        return response()->json(['success' => true, 'message' => '修改成功']);
    }


    public function active(Request $request, User $user)
    {
        $user->status = $request->checked==='true'?User::STATUS_ENABLE:User::STATUS_DISABLE ;
        $user->save();
        return response()->json(['success' => true, 'message' =>  __('Deal with success')]);
    }

    public function forbidden(Request $request){
        if($request->user()->status===User::STATUS_ENABLE){
            return redirect('/');
        }
        return view('user.disable');
    }

}
