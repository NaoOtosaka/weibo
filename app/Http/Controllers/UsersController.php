<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //创建用户的页面
    public function create(){
        return view('users.create');
    }

    //显示用户个人信息
    public function show(User $user){
        return view('users.show', compact('user'));
    }

//    处理用户注册数据验证
    public function store(Request $request){
//        信息验证
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

//        存储用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '欢迎，您已成功上路~请注意行车安全');

        return redirect()->route('users.show', [$user]);
    }

}
