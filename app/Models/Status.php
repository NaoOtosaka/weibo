<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content'];
    //指明每条微博对应一个用户
    public function user(){
        return $this->belongsTo(User::class);
    }
}
