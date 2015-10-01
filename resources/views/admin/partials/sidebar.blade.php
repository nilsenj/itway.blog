<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar sidebar-admin">
        <div class="user-title">
            <h4 class="">{{ Auth::user()->name }} <p class="pull-right"><i class="icon-circle text-success"></i> Online</p></h4>
            <!-- Status -->

        </div>
        <div class="clearfix"></div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Blog menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('admin::dashboard') }}"><i class='fa fa-th'></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('admin::roles::index') }}"><i class='fa  fa-street-view'></i> <span>Roles</span></a></li>
            <li><a href="{{ route('admin::permissions::index') }}"><i class='fa fa-user-md'></i> <span>Privileges</span></a></li>
            <li><a href="{{ route('admin::users::index') }}"><i class='fa fa-users'></i> <span>Users</span></a></li>
            <li><a href="{{ route('admin::posts::index') }}"><i class='fa fa-link'></i> <span>Posts</span> <i class="fa fa-good pull-right"></i></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
