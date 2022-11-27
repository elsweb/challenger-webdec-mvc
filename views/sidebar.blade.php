<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{APP['BASE_URL'] ??
            'localhost'}}/public/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle
            elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="javascript;;" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Cadastros
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{APP['BASE_URL'] ?? 'localhost'}}/pessoas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pessoas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{APP['BASE_URL'] ?? 'localhost'}}/logout" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>