<?php
$current_page = AdminRouter::getCurrentPage();
?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="/admin/index" class="logo">
                        <img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/img/logo.png"
                            alt="navbar brand" class="navbar-brand" height="20" />
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
                        <li class="nav-item <?= $current_page === 'index' ? 'active' : '' ?>">
                            <a href="/admin/index">
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

                        <li class="nav-item <?= $current_page === 'slider' ? 'active' : '' ?>">
                            <a href="/admin/slider">
                                <i class="fas fa-images"></i>
                                <p>Slider</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'product' ? 'active' : '' ?>">
                            <a href="/admin/product">
                                <i class="fas fa-box"></i>
                                <p>Product</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'category' ? 'active' : '' ?>">
                            <a href="/admin/category">
                                <i class="fas fa-table"></i>
                                <p>Category</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'brand' ? 'active' : '' ?>">
                            <a href="/admin/brand">
                                <i class="fa fa-tag"></i>
                                <p>Brand</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'page' ? 'active' : '' ?>">
                            <a href="/admin/page">
                                <i class="fas fa-file"></i>
                                <p>Pages</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'user' ? 'active' : '' ?>">
                            <a href="/admin/user">
                                <i class="fas fa-user"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <li class="nav-item <?= $current_page === 'settings' ? 'active' : '' ?>">
                            <a href="/admin/settings">
                                <i class="fa fa-wrench"></i>
                                <p>Settings</p>
                            </a>
                        </li>          
                    </ul>
                </div>
            </div>
        </div>
