<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('title')</title>

        @stack('styles')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>E</b>B</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Edu</b>Board</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">

                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">

                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">

                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="//www.gravatar.com/avatar/{{ md5(Sentinel::getUser()->email) }}?d=mm" alt="{{ Sentinel::getUser()->email }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        {{ Sentinel::getUser()->first_name . ' ' .  Sentinel::getUser()->last_name }}
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="//www.gravatar.com/avatar/{{ md5(Sentinel::getUser()->email) }}?d=mm" alt="{{ Sentinel::getUser()->email }}" class="img-circle" alt="User Image">

                                        <p>
                                            {{ Sentinel::getUser()->first_name . ' ' .  Sentinel::getUser()->last_name }}
                                            <small>
                                                <!-- todo: print user role-->
                                                Member since {{ date('M. Y', strtotime(Sentinel::getUser()->created_at)) }}
                                                <br>
                                                Last login {{(Sentinel::getUser()->last_login != NULL)?\Carbon\Carbon::createFromTimeStamp(strtotime(Sentinel::getUser()->last_login))->diffForHumans():'never'}}
                                            </small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">

                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Account</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('auth.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="//www.gravatar.com/avatar/{{ md5(Sentinel::getUser()->email) }}?d=mm" alt="{{ Sentinel::getUser()->email }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>
                                {{ Sentinel::getUser()->first_name . ' ' .  Sentinel::getUser()->last_name }}
                            </p>
                            <a href="#"><i class="fa fa-circle text-{{ Sentinel::check() ? 'success' : 'danger' }}"></i> {{ Sentinel::check() ? 'Online' : 'Offline' }}</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="{{ Request::is('administrator/dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        @if(Sentinel::hasAnyAccess('pages.*'))
                        <li class="treeview {{ (Request::is('administrator/pages*')) ? 'active menu-open' : '' }}">
                            <a href="#">
                                <i class="fa fa-book"></i> <span>Pages</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::is('administrator/pages') ? 'active' : '' }}"><a href="{{ route('pages.index', 'status=published') }}"><i class="fa fa-circle-o"></i> All Pages</a></li>
                                <li class="{{ Request::is('administrator/pages/create') ? 'active' : '' }}"><a href="{{ route('pages.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(Sentinel::inRole('administrator'))
                        <li class="treeview {{ (Request::is('administrator/filemanager*')) ? 'active menu-open' : '' }}">
                            <a href="#">
                                <i class="fa fa-folder-open"></i> <span>File Manager</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::is('administrator/filemanager?type=Images') ? 'active' : '' }}"><a href="{{ url('administrator/filemanager?type=Images') }}"><i class="fa fa-image"></i> Media</a></li>
                                <li class="{{ Request::is('administrator/filemanager?type=Files') ? 'active' : '' }}"><a href="{{ url('administrator/filemanager?type=Files') }}"><i class="fa fa-folder"></i> Files</a></li>
                            </ul>
                        </li>
                        <li class="treeview {{ (Request::is('administrator/users*')) ? 'active menu-open' : '' }}">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Users</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::is('administrator/users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> All Users</a></li>
                                <li class="{{ Request::is('administrator/users/create') ? 'active' : '' }}"><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                            </ul>
                        </li>
                        <li class="treeview {{ (Request::is('administrator/roles*')) ? 'active menu-open' : '' }}">
                            <a href="#">
                                <i class="fa fa-group"></i> <span>Roles</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::is('administrator/roles') ? 'active' : '' }}"><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> All Roles</a></li>
                                <li class="{{ Request::is('administrator/roles/create') ? 'active' : '' }}"><a href="{{ route('roles.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </section>
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('content-header')
                </section>
                <!-- Notifications-->
                <section class="content-header">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                            @include('includes.notifications')
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2017-2018 <a href="https://">CodeToMe Studio</a>.</strong> All rights reserved.
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane active" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <h3 class="control-sidebar-heading">General Settings</h3>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        @stack('scripts')
    </body>
</html>
