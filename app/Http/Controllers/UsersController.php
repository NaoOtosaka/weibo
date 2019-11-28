<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

//    用户列表
    public function index(){
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    //创建用户的页面
    public function create(){
        return view('users.create');
    }

    //显示用户个人信息
    public function show(User $user){
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('users.show', compact('user', 'statuses'));
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

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已经发送到你的邮箱里啦~');
        return redirect('/');
    }

//    资料编辑页面跳转
    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

//    资料更新
    public function update(User $user, Request $request){
        $this->authorize('update', $user);
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

    public function destroy(User $user){
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '这个驾照被干掉啦！');
        return back();
    }

//    邮件发送
    protected function sendEmailConfirmationTo($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = '感谢注册~请确认一下你的邮箱喔~';

        Mail::send($view, $data, function ($massage) use ($to, $subject){
            $massage->to($to)->subject($subject);
        });


    }

//    激活验证
    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你！可以上路了！');
        return redirect()->route('users.show', [$user]);
    }
}
