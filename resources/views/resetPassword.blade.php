<!DOCTYPE html>
<html>

@include('header', array('title' => 'Password',))

<body class="fixed-left login-page">

<div class="container">
    <div class="full-content-center">
        <p class="text-center"><a href="#"><img src="http://www.1000lookz.com/lib/img/logo.png" alt="Logo"></a></p>
        <div class="login-wrap animated flipInX">
            <div class="login-block">

                {!! Form::open(['role' => 'form']) !!}
                <div class="form-group login-input">
                    {!! Form::label('Change password for your account') !!}
                </div>



                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    {!! Form::password('password', ['class' => 'form-control text-input', 'placeholder' => 'Password']) !!}
                </div>

                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    {!! Form::password('confirm_password', ['class' => 'form-control text-input', 'placeholder' => 'Confirm Password']) !!}
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::submit('Reset Password', ['class' => 'btn btn-success btn-block']) !!}
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