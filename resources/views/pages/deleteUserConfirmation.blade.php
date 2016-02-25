<!DOCTYPE html>
<html>

@include('header', array('title' => 'Delete User',))

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
            <h1><i class='fa fa-ban'></i> Delete User</h1>
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
                        <h2>Do you really want to delete user  <b>{{ $users->name }}</b> ?</h2>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-content padding">
                                        <a href="/admin/users/delete/{{ $users->id }}" class="btn btn-success btn-lg btn-block">Yeah, I'm sure</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-content padding">
                                        <a href="/admin/users/manage" class="btn btn-danger btn-lg btn-block">Nope, let's go back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-content padding">
                                        <a href="/admin/users/edit/{{ $users->id }}" class="btn btn-primary btn-lg btn-block">Just edit this user</a>
                                    </div>
                                </div>
                            </div>
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