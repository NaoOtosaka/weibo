<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    gravatar头像方法
    public function gravatar($size = '100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?=$size";
    }

//    QQ头像方法
    public function QQpic($size = '100'){
        $name = strstr($this->attributes['email'], '@', true);
        return "http://q1.qlogo.cn/g?b=qq&nk=$name&s=$size";
    }

    public function headPic($size = '100'){
        if(preg_match('|^[1-9]\d{4,12}@qq\.com$|i',$this->attributes['email'])){
            return $this->QQpic($size);
        }else{
            return $this->gravatar($size);
        }
    }

}

