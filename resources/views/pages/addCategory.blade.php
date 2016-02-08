<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Add New Category");

?>

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
            <h1><i class='fa fa-book'></i> New Category</h1>
        </div>

        <div class="row">

            <div class="col-sm-6 portlets">

                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Add New Category</strong> </h2>

                    </div>
                    <div class="widget-content padding">
                        <div id="basic-form">

                            {!! Form::open(['role' => 'form', 'id' => 'myForm']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Category Name', array('for' => 'name')) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('fields', 'Field(s) needed(Ex: Total, Date)', array('for' => 'fields')) !!}
                                {!! Form::text('fields', null, ['class' => 'form-control', 'placeholder' => 'Enter field(s) needed in comma separated format']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('tags', 'Tags in category(Ex: Curry, Roti)', array('for' => 'tags')) !!}
                                {!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Enter tags in comma separated format']) !!}
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
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