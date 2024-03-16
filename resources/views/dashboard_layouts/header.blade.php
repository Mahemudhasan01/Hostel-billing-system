<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">

    <link rel="stylesheet" href="{{ asset('css/skin-green.css') }}">

    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.datetime.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.password.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script src="{{ asset('js/dataTable.bootsrap.js') }}"></script>
    

    <!-- AdminLTE App -->
    <script src="{{ asset('js/app.min.js') }}"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!--Logo -->
            <a href="" class="logo">
                <!--mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>IN</b>MS</span>
                <!--logo for regular state and mobile devices -->
                <span style="text-decoration:none;" class="logo-lg"><b>Invoice</b> System</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img width="150px" src="{{asset("images/1686740015.jpg")}}" class="user-image"
                                    alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Drop down list-->
                                <li><a href="{{route("logout")}}" class="btn btn-default btn-flat">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">


                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    {{-- <li class="header">MENU</li> --}}
                    <!-- Menu 0.1 -->
                    <li class="treeview">
                        <a href="{{ route('show.deshboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span>

                        </a>

                    </li>
                    <!-- Menu 1 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-file-text"></i> <span>Receipt</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('show.Create.Receipt') }}"><i class="fa fa-plus"></i>Create
                                    Receipt</a></li>
                            <li><a href="{{ route('show.manage.receipt') }}"><i class="fa fa-cog"></i>Manage
                                    Receipt</a></li>
                            <li><a href="{{ route('show.employee.manage.receipt') }}"><i class="fa fa-cog"></i>Manage Employee
                                    Receipt</a></li>
                            <li><a href="{{ route('show.paid.receipt') }}"><i class="fa fa-cog"></i>Search Receipt</a>
                            </li>
                            <li><a href="#" class="download-csv"><i class="fa fa-download"></i>Download CSV</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu 2 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-archive"></i><span>Rooms</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('show.rooms') }}"><i class="fa fa-plus"></i>Add Rooms</a></li>
                            <li><a href="{{ route('show.manage.room') }}"><i class="fa fa-cog"></i>Manage Rooms</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu 3 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i><span>Students</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('show.add.student') }}"><i class="fa fa-user-plus"></i>Add
                                    Student</a></li>
                            <li><a href="{{ route('show.manage.student') }}"><i class="fa fa-cog"></i>Manage
                                    Student</a></li>
                            <li><a href="{{ route('show.manage.employee') }}"><i class="fa fa-cog"></i>Employee
                                    Student</a></li>
                        </ul>
                    </li>

                    <!-- Menu 4 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i><span>System Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="user-add.php"><i class="fa fa-plus"></i>Add User</a></li>
                            <li><a href="user-list.php"><i class="fa fa-cog"></i>Manage Users</a></li>
                        </ul>
                    </li>

                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                <!-- Your Page Content Here -->
