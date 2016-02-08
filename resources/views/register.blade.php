<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Register");

?>



<body class="fixed-left login-page">

<div class="container">
    <div class="full-content-center animated fadeInDownBig">
        <p class="text-center"><a href="#"><img src="http://www.1000lookz.com/lib/img/logo.png" alt="Logo"></a></p>
        <div class="login-wrap">
            <div class="login-block">

                {!! Form::open(['role' => 'form', 'id' => 'myForm']) !!}
                <div class="form-group login-input">
                    <i class="fa fa-envelope overlay"></i>
                    {!! Form::text('email', null, ['class' => 'form-control text-input', 'placeholder' => 'E-Mail']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-user overlay"></i>
                    {!! Form::text('name', null, ['class' => 'form-control text-input', 'placeholder' => 'Name']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    {!! Form::password('password', ['class' => 'form-control text-input', 'placeholder' => 'Password']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    {!! Form::password('confirm_password', ['class' => 'form-control text-input', 'placeholder' => 'Confirm Password']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-hashtag overlay"></i>
                    {!! Form::text('eid', null, ['class' => 'form-control text-input', 'placeholder' => 'Employee ID']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-briefcase overlay"></i>
                    {!! Form::text('company', null, ['class' => 'form-control text-input', 'placeholder' => 'Company']) !!}
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::submit('Register', ['class' => 'btn btn-success btn-block']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                @include('errors.errors')

            </div>
        </div>

    </div>
</div>

<div class="md-overlay"></div>
@include('footer');
</body>
</html>