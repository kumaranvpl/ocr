<!DOCTYPE html>
<html>

@include('header', array('title' => 'Edit Category',))

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
            <h1><i class='fa fa-book'></i> Edit Category</h1>
        </div>

        <div class="row">

            <div class="col-sm-6 portlets">

                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Update Existing Category</strong> </h2>

                    </div>
                    <div class="widget-content padding">
                        <div id="basic-form">

                            {!! Form::open(['role' => 'form', 'id' => 'myForm']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Category Name:') !!}
                                {!! Form::label('name_value', $categories->category_name, array('style' => 'font-size:18px')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('fields', 'Field(s) needed', array('for' => 'fields1')) !!}
                                {!! Form::select('fields[]', $fields, $categories->getFieldList(), ['id' => 'fields_list', 'class' => 'form-control', 'multiple']) !!}
                            </div>

                            <!--<div class="form-group">
                                {!! Form::label('tags', 'Tags in category(Ex: Curry, Roti)', array('for' => 'tags')) !!}
                                {!! Form::text('tags', $categories->tags, ['class' => 'form-control', 'placeholder' => 'Enter tags in comma separated format']) !!}
                            </div>-->

                            {{ Form::hidden('invisible_id', $categories->id, array('id' => 'invisible_id')) }}

                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
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

<script>
    $('#fields_list').select2();
</script>
</body>
</html>