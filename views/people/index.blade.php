<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>
    <meta name="base_url" content="{{APP['BASE_URL'] ?? 'localhost'}}">
    <meta name="csrf" content="{{$csrf ?? null}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/dist/css/adminlte.min.css">
    <link href="{{APP['BASE_URL'] ?? 'localhost'}}/public/css/style.css?t={{time()}}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('navbar')
        @include('sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pessoas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pessoas</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div style="width: 100%; margin: 10px;">
                                    <a href="javascript:add();"><i class='fas fa-user-plus' style='font-size: 1.5rem;'></i></a>
                                </div>
                                <div id="loadpreloaddelete">
                                    <img width="30" src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/load.svg">
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="loadpreloadlist">
                                        <img width="50" src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/load.svg">
                                    </div>
                                    <table id="datatable" class="table
                                            table-bordered table-striped">
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All
            rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Modal peopleform -->
    @include('people.form')
    @include('people.phone')

    <!-- jQuery -->
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/jquery/jquery.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script
        src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script
        src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/jszip/jszip.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{APP['BASE_URL'] ??
            'localhost'}}/public/assets/adminLTE320/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/js/helper.js?t={{time()}}"></script>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/js/people.js?t={{time()}}"></script>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/js/phone.js?t={{time()}}"></script>

    </script>
</body>

</html>

</html>