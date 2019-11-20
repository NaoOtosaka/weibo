{{--<html>--}}
{{--<head>--}}
{{--    <title>Weibo app</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--    <h1>主页</h1>--}}
{{--</body>--}}
{{--</html>--}}
@extends('layout.default')

@section('content')
    <div class="jumbotron">
        <h1>Hello</h1>
        <p class="lead">
            这里是基于<a href="https://learnku.com/">Laravel</a>的个人项目主页
        </p>
        <p>
            小老弟，你想有一个发言讨论的平台吗？
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
        </p>
    </div>
@stop
