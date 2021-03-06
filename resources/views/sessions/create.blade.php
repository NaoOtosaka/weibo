@extends('layout.default')
@section('title', '登陆')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>登陆</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')

                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码(<a href="{{ route('password.request') }}">忘记密码</a>)</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                            <ladel class="form-check-label" for="exampleCheck1">
                                记住我
                            </ladel>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">上路</button>
                </form>

                <hr>

                <p>还没有驾照？<a href="{{ route('signup') }}">现在注册！</a></p>
            </div>
        </div>
    </div>
@stop
