<?php
$role = session()->get('role');
$uri = service('uri');
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-box">M</div>
        <span class="sidebar-title">Miloo Shop</span>
    </div>

    <div class="nav-links">
        <li class="nav-item">
            <a href="/" class="nav-link" style="background: rgba(255,255,255,0.05); margin-bottom: 1.5rem; color: #10b981;">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Toko</span>
            </a>
        </li>

        <?php if ($role === 'admin') : ?>
            <div class="menu-label">Menu Utama</div>
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link <?= $uri->getSegment(2) == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <div class="menu-label">Manajemen</div>
            <li class="nav-item">
                <a href="/admin/content" class="nav-link">
                    <i class="fas fa-edit"></i>
                    <span>Manajemen Konten</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/shops" class="nav-link <?= $uri->getSegment(2) == 'shops' ? 'active' : '' ?>">
                    <i class="fas fa-store"></i>
                    <span>Daftar Toko</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/products" class="nav-link">
                    <i class="fas fa-boxes"></i>
                    <span>Moderasi Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/users" class="nav-link <?= $uri->getSegment(2) == 'users' ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <div class="menu-label">Laporan</div>
            <li class="nav-item">
                <a href="/admin/reports" class="nav-link">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Laporan</span>
                </a>
            </li>

        <?php elseif ($role === 'penjual') : 
            $shopModel = new \App\Models\ShopModel();
            $myShop = $shopModel->where('user_id', session()->get('user_id'))->first();
        ?>
            <div class="menu-label">Seller Center</div>
            <li class="nav-item">
                <a href="/shop/<?= $myShop['id'] ?? '0' ?>" class="nav-link" style="background: rgba(16, 185, 129, 0.1); color: #10b981; margin-bottom: 1rem;">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Masuk Toko Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/seller/dashboard" class="nav-link <?= $uri->getSegment(2) == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard Toko</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/seller/products" class="nav-link <?= $uri->getSegment(2) == 'products' ? 'active' : '' ?>">
                    <i class="fas fa-box"></i>
                    <span>Produk Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/seller/orders" class="nav-link">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pesanan Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/seller/notes" class="nav-link">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi Admin</span>
                </a>
            </li>

        <?php else : ?>
            <div class="menu-label">Menu Pembeli</div>
            <li class="nav-item">
                <a href="/dashboard" class="nav-link active">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Belanja Sekarang</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/orders" class="nav-link">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Pesanan</span>
                </a>
            </li>
            
            <div class="menu-label">Penjual</div>
            <li class="nav-item">
                <a href="/seller/open-shop" class="nav-link">
                    <i class="fas fa-store"></i>
                    <span>Buka Toko</span>
                </a>
            </li>
        <?php endif; ?>
    </div>

    <div style="margin-top: auto;">
        <a href="/logout" class="nav-link" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </div>
</aside>
