<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Admin Dashboard");

?>

<body class="fixed-left">

@include('pages.adminTopBar');

@include('pages.adminSideBar');


<div class="md-overlay"></div>
@include('footer');
</body>
</html>