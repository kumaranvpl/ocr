<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Manage Categories");

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
            <h1><i class='fa fa-book'></i> Manage Categories</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('flash::message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-header transparent">
                        <h2><strong>Categories</strong></h2>
                    </div>


                    {!! Form::open(array('url' => '/admin/categories/update'), ['role' => 'form']) !!}
                    <div class="widget-content">
                        <div class="data-table-toolbar">
                            <div class="row">
                                <div class="col-md-4">
                                    <!--<form role="form">
                                        <input type="text" class="form-control" placeholder="Search...">
                                    </form>-->
                                </div>
                                <div class="col-md-8">
                                    <div class="toolbar-btn-action">
                                        <!--<a href="/admin/categories/add" class="btn btn-success"><i class="fa fa-refresh"></i> Update</a>-->
                                        {{ Form::button('<i class="fa fa-refresh"></i> Update Preferences', ['type' => 'submit', 'class' => 'btn btn-success'] )  }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table data-sortable class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Category Name</th>
                                    <th>Fields Needed</th>
                                    <!--<th>Tags</th>-->
                                    <th>Added/Updated On</th>
                                    <th data-sortable="false">Edit</th>
                                    <th data-sortable="false">Enable/Disable</th>
                                </tr>
                                </thead>

                                <tbody>
                                {{--*/ $count = (($categories->currentPage() - 1 ) * $categories->perPage() ) /*--}}
                                @foreach($categories as $category)
                                    <tr>
                                        <!--<td>{{ $category->id }}</td>-->
                                        <td>{{ ++$count }}</td>
                                        <td><strong>{{ $category->category_name }}</strong></td>
                                        <td>{{ $category->fields_needed }}</td>
                                        <!--<td>{{ $category->tags }}</td>-->
                                        <td>{{ $category->time_created }}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="/admin/categories/edit/{{ $category->id }}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                        {{--*/ $value = null /*--}}
                                        @if($category->is_enabled=="yes") {{--*/ $value = true /*--}} @endif
                                        <td>{{ Form::checkbox('enabled[]', $category->id, $value, ['class' => 'rows-check']) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table-toolbar">
                            {!! $categories->links() !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
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