<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CoadingBrackets || @yield('page-title')</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="uxliner" />
    <!-- v4.1.3 -->
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/img/favicon-16x16.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/et-line-font/et-line-font.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/simple-lineicon/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print"
        onload="this.onload=null;this.media='all';">


    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <style>
        /* Success Toast */
        .toast-success {
            background-color: #115234 !important;
            /* Bootstrap success green */
            color: #ffffff !important;
        }

        /* Error Toast */
        .toast-error {
            background-color: #451318 !important;
            /* Bootstrap danger red */
            color: #ffffff !important;
        }

        /* Warning Toast */
        .toast-warning {
            background-color: #4a3c14 !important;
            /* Bootstrap warning yellow */
            color: #000000 !important;
        }

        /* Optional: Close button color for all toasts */
        .toast-close-button {
            color: #ffffff !important;
            opacity: 1;
        }

        .toast-warning .toast-close-button {
            color: #000000 !important;
        }
    </style>

</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index.html" class="logo blue-bg">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{ asset('dist/img/logo-small.png') }}" alt=""></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ asset('dist/img/logo.png') }}" alt=""></span> </a>
            <!-- Header Navbar -->
            <nav class="navbar blue-bg navbar-static-top">
                <!-- Sidebar toggle button-->
                <ul class="nav navbar-nav pull-left">
                    <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
                </ul>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account  -->
                        <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle"
                                data-toggle="dropdown">
                                @if (session('ADMIN_IMAGE'))
                                    <img src="{{ asset('uploads/admins/' . session('ADMIN_IMAGE')) }}"
                                        class="user-image" alt="User Image">
                                @else
                                    <img src="{{ asset('user-icon.webp') }}" class="user-image" alt="User Image">
                                @endif
                                <span class="hidden-xs">{{ session('ADMIN_NAME') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <div class="pull-left user-img">
                                        @if (session('ADMIN_IMAGE'))
                                            <img src="{{ asset('uploads/admins/' . session('ADMIN_IMAGE')) }}"
                                                class="img-responsive img-circle" alt="User Image">
                                        @else
                                            <img src="{{ asset('user-icon.webp') }}" class="img-responsive img-circle"
                                                alt="User Image">
                                        @endif
                                    </div>
                                    <p class="text-left">{{ session('ADMIN_NAME') }}
                                        <small>{{ session('ADMIN_EMAIL') }}</small>
                                    </p>
                                </li>
                                {{-- <li><a href="#"><i class="icon-profile-male"></i> My Profile</a></li>
                                <li><a href="#"><i class="icon-wallet"></i> My Balance</a></li>
                                <li><a href="#"><i class="icon-envelope"></i> Inbox</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li> --}}
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gear animated "></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="image text-center">
                        @if (session('ADMIN_IMAGE'))
                            <img src="{{ asset('uploads/admins/' . session('ADMIN_IMAGE')) }}" class="img-circle"
                                alt="User Image">
                        @else
                            <img src="{{ asset('user-icon.webp') }}" class="img-circle" alt="User Image">
                        @endif

                    </div>
                    <div class="info">
                        <p>{{ session('ADMIN_NAME') }}</p>
                        {{-- <a href="#"><i class="fa fa-envelope"></i> </a>
                        <a href="#"><i class="fa fa-gear"></i></a> --}}
                        <a href="{{ route('admin.logout') }}">
                            <i class="fa fa-power-off"></i></a>
                    </div>
                </div>

                <!-- sidebar menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home me-2"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('admin.ourTeam') ? 'active' : '' }}">
                        <a href="{{ route('admin.ourTeam') }}"> <i class="fa fa-users me-2"></i><span>Our
                                Teams</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.website') ? 'active' : '' }}">
                        <a href="{{ route('admin.website') }}"> <i class="fa fa-laptop me-2"></i><span>Website
                                Type</span>
                        </a>
                    </li>
                    <li class="header">Servces and Services Content</li>
                    <li
                        class="treeview {{ request()->routeIs('admin.services') || request()->routeIs('admin.services.content') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-globe me-2"></i><span>Services</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
                                <a href="{{ route('admin.services') }}"><i class="fa fa-angle-right"></i> Add
                                    Services</a>
                            </li>
                            <li class="{{ request()->routeIs('admin.services.content') ? 'active' : '' }}">
                                <a href="{{ route('admin.services.content') }}"><i class="fa fa-angle-right"></i> Add
                                    Services Content</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('admin.technology') ? 'active' : '' }}">
                        <a href="{{ route('admin.technology') }}"> <i
                                class="fa fa-cloud me-2"></i><span>Technologies</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('admin.service.offer') ? 'active' : '' }}">
                        <a href="{{ route('admin.service.offer') }}"> <i class="fa  fa-wrench me-2"></i><span>Offer
                                Services</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header sty-one">
                <h1>@yield('page-title')</h1>
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li><i class="fa fa-angle-right"></i> @yield('page-title')</li>
                </ol>
            </div>

            <!-- Main content -->
            <div class="content">
                @section('admin-content')
                @show('admin-content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">Version 1.0</div>
            Copyright © 2018 Yourdomian. All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab"></div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('dist/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- template -->
    <script src="{{ asset('dist/js/bizadmin.js') }}"></script>

    <!-- Jquery Sparklines -->
    <script src="{{ asset('dist/plugins/jquery-sparklines/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/jquery-sparklines/sparkline-int.js') }}"></script>

    <!-- Morris JavaScript -->
    <script src="{{ asset('dist/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('dist/plugins/morris/morris.js') }}"></script>
    <script src="{{ asset('dist/plugins/functions/dashboard1.js') }}"></script>

    <!-- for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    @if (session()->has('success') || session()->has('error') || session()->has('warning'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-right",
                    closeButton: true,
                    timeOut: 5000
                };

                let successMessage = "{{ session('success') }}";
                let errorMessage = "{{ session('error') }}";
                let warningMessage = "{{ session('warning') }}";

                if (successMessage) {
                    toastr.success(successMessage);
                }

                if (errorMessage) {
                    toastr.error(errorMessage);
                }

                if (warningMessage) {
                    toastr.warning(warningMessage);
                }
            });
        </script>
    @endif
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all tables with class 'myTable'
            document.querySelectorAll('.myTable').forEach(table => {
                new DataTable(table);
            });
        });
    </script>

</body>

</html>
