<!DOCTYPE html>
<html>
<head>
    <title>Verify email</title>
</head>
<body>
    <h2>Hi {{ $users->name }},</h2>
    <br>
    <p>You have registered for the paperwork.<br>
    Verify your mail by going to this {{ Html::link($url, 'Link') }}  <br></p>
</body>
</html>