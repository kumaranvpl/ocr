<!DOCTYPE html>
<html>

@include('header', array('title' => 'Admin Dashboard',))

<body class="fixed-left">

@include('pages.adminTopBar');

@include('pages.adminSideBar');

<div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="content">
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class='fa fa-book'></i> Admin Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('flash::message')
            </div>
        </div>



    </div>
</div>

<div class="md-overlay"></div>
@include('footer');
<script>
    $('div.alert').delay(3000).slideUp(300);
</script>
</body>
</html>