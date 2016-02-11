<!DOCTYPE html>
<html>
<head>
    <title>Verify email</title>
</head>
<body>
    <h2>Hi {{ $users->name }},</h2>
    <br>
    <p>You have registered for the paperwork.<br>
    Verify your mail by going to this link <a href="{!! $url !!}">here</a>  <br></p>
</body>
</html>