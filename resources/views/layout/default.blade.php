<html>
<head>
    <title>@yield('title', 'Weibo App')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    @include('layout._header')

    <div class="container">
        @include('shared._messages')
        @yield('content')   <!--用于显示content区块的内容，内容由继承自该模板的子视图定义-->
        @include('layout._footer')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
