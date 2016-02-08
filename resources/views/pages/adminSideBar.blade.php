<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!-- Search form -->

        <div class="clearfix"></div>
        <br>
        <!--- Profile -->
        <div class="profile-info">
            <div class="col-xs-8">
                <div class="profile-text">Welcome <b>{{ base64_decode($_COOKIE['name']) }}</b></div>
            </div>
        </div>
        <!--- Divider -->
        <div class="clearfix"></div>
        <hr class="divider" />
        <div class="clearfix"></div>
        <!--- Divider -->

        <div id="sidebar-menu">
            <ul>
                <li ><a href='/admin/users/manage'><i class='fa fa-users'></i><span>Manage Users</span></a></li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-clock-o'></i><span>Pending Approvals</span></a></li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-thumbs-up'></i><span>Files Approved</span></a></li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-thumbs-down'></i><span>Files Rejected</span></a></li>
                <li ><a href='/admin/categories/manage'><i class='fa fa-pie-chart'></i><span>Manage Categories</span></a></li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-print'></i><span>Print and Export</span></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>

        <div class="clearfix"></div><br><br><br>
    </div>
    <div class="left-footer">
        <div class="progress progress-xs">
            <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="progress-precentage">80%</span>
            </div>

            <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
        </div>
    </div>
</div>