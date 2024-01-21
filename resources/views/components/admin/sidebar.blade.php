<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('Admin.Dashboard') }}">
        <div class="sidebar-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="26" fill="#f8f9fc"
                viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M192 496C86 496 0 394 0 288C0 176 64 16 192 16s192 160 192 272c0 106-86 208-192 208zM154.8 134c6.5-6 7-16.1 1-22.6s-16.1-7-22.6-1c-23.9 21.8-41.1 52.7-52.3 84.2C69.7 226.1 64 259.7 64 288c0 8.8 7.2 16 16 16s16-7.2 16-16c0-24.5 5-54.4 15.1-82.8c10.1-28.5 25-54.1 43.7-71.2z" />
            </svg>
        </div>
        <div class="sidebar-brand-text mx-3">Telurku</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::current()->getName() == 'Admin.Dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Admin.Dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Produk
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::current()->getName() == 'Admin.Products' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Admin.Products') }}">
            <i class="fas fa-fw fa-egg"></i>
            <span>Daftar Produk</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Route::current()->getName() == 'Admin.CreateProduct' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Admin.CreateProduct') }}"">
            <i class="fas fa-fw fa-plus"></i>
            <span>Tambah Produk</span>
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pesanan
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Route::current()->getName() == 'Admin.Orders' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Admin.Orders') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Semua Pesanan</span></a>
    </li>

    <li class="nav-item {{ Route::current()->getName() == 'Admin.OrdersByStatus' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
            aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pesanan Masuk</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Status:</h6>
                <a class="collapse-item" href="{{ route('Admin.OrdersByStatus', 'waiting') }}">Menunggu</a>
                <a class="collapse-item" href="{{ route('Admin.OrdersByStatus', 'accepted') }}">Diproses</a>
                <a class="collapse-item" href="{{ route('Admin.OrdersByStatus', 'done') }}">Selesai</a>
                <a class="collapse-item" href="{{ route('Admin.OrdersByStatus', 'canceled') }}">Dibatalkan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Route::current()->getName() == 'Admin.Users' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Admin.Users') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Daftar User</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
