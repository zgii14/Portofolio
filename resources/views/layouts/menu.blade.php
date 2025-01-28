<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item">
        <a href="{{ route("dashboard") }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">Manejemen Data Master</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i>
            <span>Data Master</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route("admin.users.index") }}">Pengguna</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route("mahasiswa.index") }}">Mahasiswa</a>
            </li>
        </ul>
    </li>
    <li class="menu-header">Manajemen Pemesanan</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i>
            <span>Data Pesanan</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link">Paket Laundry</a>
            </li>
            <li>
                <a class="nav-link">Pemesanan</a>
            </li>
        </ul>
    </li>

    <li class="menu-header">Manejemen Transaksi</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i>
            <span>Data Transaksi</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link">Riwayat Transaksi</a>
            </li>
            <li>
                <a class="nav-link">Riwayat Pesanan Saya</a>
            </li>
        </ul>
    </li>
</ul>
