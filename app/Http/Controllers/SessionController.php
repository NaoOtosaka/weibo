<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionController extends Controller
{
    //登陆
    public function create(){
        return view('sessions.create');
    }

//    验证登录信息
    public function store(Request $request){
//        完整性验证
        $credentials = $this->validate($request,[
                'email' => 'required|email|max:255',
                'password' => 'required'
            ]);
//        身份验证
        if (Auth::attempt($credentials)){
//            登陆成功
            session()->flash('success', '欢迎回到路上');
            return redirect()->route('users.show', [Auth::user()]);
        }else{
//            登录失败
            session()->flash('danger', '您的驾照过期或者不存在喔~');
            return redirect()->back()->withInput();
        }
    }
}


