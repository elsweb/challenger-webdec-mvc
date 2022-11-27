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
    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Cadastro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="peopleform" onSubmit="save(); return false">
                        <input type="hidden" name="id" id="id">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Nome*</span>
                            </div>
                            <input type="text" name="nome" id="nome" class="form-control input_user"
                                required="required">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Nascimento*</span>
                            </div>
                            <input type="date" name="data_nascimento" id="data_nascimento"
                                class="form-control input_user" required="required">
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">CPF*</span>
                                    </div>
                                    <input type="text" name="cpf" id="cpf" class="form-control input_pass"
                                        required="required">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">RG*</span>
                                    </div>
                                    <input type="text" name="rg" id="rg" class="form-control input_pass"
                                        required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Estado*</span>
                                    </div>
                                    <input type="text" name="uf" id="uf" class="form-control input_pass"
                                        required="required" maxlength="2">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">CEP*</span>
                                    </div>
                                    <input type="text" name="cep" id="cep" class="form-control input_pass"
                                        required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rua*</span>
                                    </div>
                                    <input type="text" name="endereco" id="endereco" class="form-control input_pass"
                                        required="required">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">N°*</span>
                                    </div>
                                    <input type="text" name="numero" id="numero" class="form-control input_pass"
                                        required="required">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:clearForm('peopleform');" id="btnclear" class="btn btn-primary">Limpar</a>
                        <button id="submit_reg" type="submit" class="btn btn-primary">Salvar</button>
                        <div id="loadpreloadreg">
                            <img width="30" src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/load.svg">
                        </div>
                    </form>
                    <div id="msgloadreg">
                        <div class="alert alert-primary" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    </script>
</body>

</html>

</html>