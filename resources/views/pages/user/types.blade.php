<!DOCTYPE html>
<html>

@include('header', array('title' => 'Uploads',))

<body class="fixed-left">

@include('pages.user.userTopBar');

@include('pages.user.userSideBar');

<div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <!-- Trigger the modal with a button -->
    <!-- Modal -->
    @include('pages.user.modalExampleImages');

    <div class="content">
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class='fa fa-cloud-upload'></i> Upload Image for {!! $category->category_name !!}</h1>
        </div>
        <div class="row">
            <div class="col-sm-12 portlets">
                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Upload Image for {!! $category->category_name !!}</strong> </h2>
                    </div>
                    <div class="widget-content padding">
                        <button type="button" class="btn btn-danger btn-sm md-trigger" data-toggle="modal" data-target="#myModal">Examples</button>
                    </div>
                    <div class="widget-content padding">
                        <div id="basic-form">
                            {!! Form::open(['role' => 'form', 'id' => 'myForm', 'files' => 'true']) !!}
                                <div class="form-group">
                                    {!! Form::label('bill_image', 'Bill Image', array('class' => 'col-sm-2 control-label','for' => 'image')) !!}
                                    {!! Form::file('image', ['class' => 'btn btn-blue-2', 'title' => 'Choose Image']) !!}
                                </div>
                                <br>
                                <div class="form-group">
                                    {!! Form::label('billType', 'Bill Type', array('class' => 'col-sm-2 control-label','for' => 'bill_type')) !!}
                                    <div class="col-sm-10">
                                        @foreach(explode(',', $category->bill_types) as $types)
                                            <div class="radio iradio">
                                                <label>
                                                    {{ Form::radio('bill_type', trim($types)) }}
                                                    {!! $types !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{ Form::hidden('category', $_GET['category']) }}
                                <div class="row">
                                    <div class="col-sm-12">
                                        {!! Form::submit('Upload Image for processing', ['class' => 'btn btn-success']) !!}
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