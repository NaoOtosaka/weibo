@extends('layout.default')
@section('title', '编辑资料')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                编辑个人资料
            </div>
            <div class="card-body">

                @include('shared._errors')

                <div class="gravatar_edit">
                        <img src="{{ $user->headPic('640') }}" alt="{{ $user->name }}" class="gravatar">
                </div>

                <form method="post" action="{{ route('users.update', $user->id) }}">

{{--                    伪造隐藏域--}}
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        更新
                    </button>

                </form>

            </div>
        </div>
    </div>
@stop
