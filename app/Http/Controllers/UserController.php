<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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



}
