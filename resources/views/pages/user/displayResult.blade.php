<!DOCTYPE html>
<html>

@include('header', array('title' => 'Processing Result',))

<body class="fixed-left">

@include('pages.user.userTopBar');

@include('pages.user.userSideBar');

<div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <!-- Trigger the modal with a button -->
    <!-- Modal -->


    <div class="content">
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class='fa fa-cloud-upload'></i> Processed uploaded image results</h1>
        </div>
        <div class="row">
            <div class="col-sm-12 portlets">
                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>
                                {!! $json_res->BILL_TYPE or "Unknown Bill Type" !!}
                            </strong>
                        </h2>
                    </div>
                    <div class="widget-content padding">
                        <div id="basic-form">
                            {!! Form::open(['role' => 'form', 'id' => 'myForm']) !!}
                            @foreach ($json_res as $key => $value)
                                <div class="form-group">
                                    {!! Form::label($key, $value) !!}
                                </div>
                            @endforeach
                            {!! Form::close() !!}
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