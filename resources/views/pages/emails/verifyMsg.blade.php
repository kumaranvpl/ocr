<!DOCTYPE html>
<html>

@include('header', array('title' => $title,))

<body class="fixed-left">

<div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="content">
        <!-- Page Heading Start -->
        <div class="row">

            <div class="col-sm-6 portlets">

                <div class="widget">

                    <div class="widget-content padding">
                        <div class="alert alert-success">
                            {{ $msg }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="md-overlay"></div>
@include('footer');
</body>
</html>