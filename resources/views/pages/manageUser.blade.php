<!DOCTYPE html>
<html>
<?php
echo view('header')->with('title', "Manage Users");

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
            <h1><i class='fa fa-book'></i> Manage Users</h1>
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
                        <h2><strong>Users</strong></h2>
                    </div>
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
                                        <a href="/admin/users/add" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table data-sortable class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Employee ID</th>
                                    <th>Company</th>
                                    <th>Created/Updated On</th>
                                    <th data-sortable="false">Option</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td><td><strong>{{ $user->name }}</strong></td>
                                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        <td>{{ $user->employee_id }}</td>
                                        <td>{{ $user->company }}</td>
                                        <td>{{ $user->time_created }}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="/admin/users/edit/{{ $user->id }}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                <a href="/admin/users/delete/{{ $user->id }}" data-toggle="tooltip" title="Delete" class="btn btn-default"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table-toolbar">
                            {!! $users->links() !!}
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
    $('div.alert').delay(3000).slideUp(300);
</script>
</body>
</html>