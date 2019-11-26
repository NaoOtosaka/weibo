<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>注册确认链接</title>
</head>
<body>
    <h1>感谢您在在本网站进行注册！</h1>
    <p>
        请点击下面的链接完成上路前的最后一项准备工作！
        <a href="{{ route('confirm_email', $user->activation_token) }}">
            {{ route('confirm_email', $user->activation_token) }}
        </a>
    </p>

    <p>
        如果这不是您本人的操作，请忽略此邮件！
    </p>
</body>
</html>
