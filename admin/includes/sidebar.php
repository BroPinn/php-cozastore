<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.php?page=index" class="logo">
                        <img
                            src="assets/img/kaiadmin/logo_light.svg"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a
                                href="index.php?page=index"
                                aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li class="nav-item <?= urlIs('index.php') ? 'active' : '' ?>">
                            <a href="index.php?page=index">
                                <i class="fas fa-layer-group"></i>
                                <p>Base</p>
                            </a>
                        </li>
                        <li class="nav-item <?= urlIs('slider.php') ? 'active' : '' ?>">
                            <a href="index.php?page=slider">
                                <i class="fas fa-th-list"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item <?= urlIs('product.php') ? 'active' : '' ?>">
                            <a href="index.php?page=product">
                                <i class="fa fa-box"></i>
                                <p>Product</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tables">
                                <i class="fas fa-table"></i>
                                <p>Tables</p>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="#maps">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Maps</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#charts">
                                <i class="far fa-chart-bar"></i>
                                <p>Charts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#">
                                <i class="fas fa-desktop"></i>
                                <p>Widgets</p>
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#">
                                <i class="fas fa-file"></i>
                                <p>Documentation</p>
                                <span class="badge badge-secondary">1</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu">
                                <i class="fas fa-bars"></i>
                                <p>Menu Levels</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>