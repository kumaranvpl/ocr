<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Hi {{ $users->name }},</h2>
<br>
<p>Here is the password reset link.<br>
    Reset your password by going to this link {{ Html::link($url) }}  <br></p>
</body>
</html>