@extends('layout.default')
@section('title', '注册')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>注册</h5>
            </div>
            <div class="card-body">

{{--                错误信息反馈--}}
                @include('shared._errors')

                <form action="{{ route('users.store') }}" method="post">

{{--                    token添加--}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">尊姓大名：</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">怎么联系：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">您的密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认一下：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        上路
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop
