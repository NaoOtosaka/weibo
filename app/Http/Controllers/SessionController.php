<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
           'only' => ['create'],
        ]);
    }

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
        if (Auth::attempt($credentials, $request->has('remember'))){
//            激活验证
            if (Auth::user()->activated){
                //            登陆成功
                session()->flash('success', '欢迎回到路上');
//                $fallback = route('users.show', [Auth::user()]);
//                return redirect()->intended($fallback);
                return redirect('/');
            }else{
//                未验证的账号
                Auth::logout;
                session()->flash('warning', '你的账号还没有激活哦，请检查邮箱中的注册邮件进行激活');
                return redirect('/');
            }
        }else{
//            登录失败
            session()->flash('danger', '您的驾照过期或者不存在喔~');
            return redirect()->back()->withInput();
        }
    }

    //    登出操作
    public function destroy(){
        Auth::logout();
        session()->flash('success', '请好好休息~');
        return redirect('login');
    }
}


