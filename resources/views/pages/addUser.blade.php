<!DOCTYPE html>
<html>

@include('header', array('title' => 'Add New User',))

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
            <h1><i class='fa fa-plus'></i> New User</h1>
        </div>

        <div class="row">

            <div class="col-sm-6 portlets">

                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Add New user</strong> </h2>

                    </div>
                    <div class="widget-content padding">
                        <div id="basic-form">

                            {!! Form::open(['role' => 'form', 'id' => 'myForm']) !!}
                            <div class="form-group">
                                {!! Form::label('eid', 'Employee ID of User', array('for' => 'eid')) !!}
                                {!! Form::text('eid', null, ['class' => 'form-control', 'placeholder' => 'Enter Employee ID']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'E-Mail Address of User', array('for' => 'email')) !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-Mail Address']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('name', 'Name of User', array('for' => 'name')) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Add User', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}

                            @include('errors.errors')
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