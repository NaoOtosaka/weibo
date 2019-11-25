<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Auth;

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

        Auth::login($user);
        session()->flash('success', '欢迎，您已成功上路~请注意行车安全');

        return redirect()->route('users.show', [$user]);
    }

//    资料编辑页面跳转
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

//    资料更新
    public function update(User $user, Request $request){
        $this->validate($request,[
           'name' => 'required|max:50',
           'password' => 'nullable|confirmation|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
//        验证密码是都修改
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '您的资料更新好啦~');

        return redirect()->route('users.show', $user);
    }
}
