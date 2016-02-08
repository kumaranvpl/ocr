<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Uploads");

?>

<body class="fixed-left">

@include('pages.user.userTopBar');

@include('pages.user.userSideBar');

    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="page-heading">
                <h1><i class='fa fa-th'></i> Categories</h1>
                <h3>Select appropriate category</h3>
            </div>

            <div class="row">
                @foreach($categories as $category)
                    <div class="col-sm-3">
                        <div class="widget">
                            <div class="widget-content padding">
                                <h2><a href="/user/uploads/types?category={!! base64_encode($category->id) !!}" class="btn btn-success btn-lg btn-block" type="button">
                                    {!! $category->category_name !!}
                                </a></h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End content here -->
        <!-- ============================================================== -->

    </div>


<div class="md-overlay"></div>
@include('footer');
</body>
</html>