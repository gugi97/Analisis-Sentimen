<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Analisis Sentimen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- DataTables CDN -->
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap/css/bootstrap.min.css">
</head>

<body class="hold-transition layout-fixed sidebar-mini" style="background-color:#f4f6f9;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark border-bottom-0" style="background-color : #1DA1F2;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" id="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4 sidebar-no-expand">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="AdminLTE/dist/img/twitter-icon.png" alt="Twitter Logo" class="brand-image">
                <span class="brand-text font-weight-bolder" style="color:#1DA1F2;">Analisis Sentimen</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-2 pb-2 mb-3 d-flex">
                    <div class="image">
                        <img src="AdminLTE/dist/img/1711500742.jpg" class="img-circle " alt="User Image"
                            id="profile-image" style="width: 65px; height: 65px">
                    </div>
                    <div class="info">
                        <div id="profile-desc">
                            <a class="d-block" style="font-size: 21px; font-weight: 600;" id="profile-desc">Gugi Gerar</a>
                            <a class="d-block" style="font-size: 14px;" id="profile-desc">1711500742</a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{url ('/')}}" class="nav-link {{ set_active('home') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Dataset
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('trainingkotor')}}" class="nav-link">
                                        <i class="fas fa-database nav-icon"></i>
                                        <p>Data Training</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('testingkotor')}}" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Data Testing</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Preprocessing
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('dataset')}}" class="nav-link">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Preprocessing</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index2.html" class="nav-link">
                                        <i class="fas fa-tag nav-icon"></i>
                                        <p>Labeling</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('slangword')}}" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Slangword List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index2.html" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Stopword List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <!-- <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div> -->
            <center>2020&copy; <strong>Gugi Gerar</strong> | Universitas Budi Luhur</center>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="AdminLTE/dist/js/demo.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#pushmenu').click(function () {
                if ($("body").hasClass("sidebar-collapse")) {
                    $('#profile-image').css('width', '60px');
                    $('#profile-image').css('height', '60px');
                    $('#profile-desc').show();
                } else {
                    $('#profile-image').css('width', '33px');
                    $('#profile-image').css('height', '33px');
                    $('#profile-desc').hide();
                }
            });
        });

    </script>
</body>

</html>
