<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "404 Page Not Found");

?>

<body class="fixed-left">

<body class="fixed-left full-content">


<!-- Begin page -->
<div class="container">
    <div class="full-content-center animated flipInX">
        <h1>404</h1>
        <h2>The page you are looking for is definitely not this!</h2><br>
        <br>
        <a class="btn btn-primary btn-sm" href="/user/dashboard"><i class="fa fa-angle-left"></i> Back to Dashboard</a>
    </div>
</div>


<div class="md-overlay"></div>
@include('footer');
</body>
</html>