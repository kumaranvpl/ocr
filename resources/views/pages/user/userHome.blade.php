<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "User Dashboard");

?>

<body class="fixed-left">

@include('pages.user.userTopBar');

@include('pages.user.userSideBar');


<div class="md-overlay"></div>
@include('footer');
</body>
</html>