@extends('layout.default');
@section('title', '重置密码')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>重置密码</h5>
            </div>
            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
                        <lable for="email" class="form-check-label">邮箱地址:</lable>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="form-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            发送邮件重置密码
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
