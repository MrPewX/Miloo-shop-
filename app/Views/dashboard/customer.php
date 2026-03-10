<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card bg-gradient-primary text-white mb-4" style="background: linear-gradient(135deg, var(--primary), #a855f7); border: none; padding: 2.5rem;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="display-6 font-weight-bold mb-2">Halo, <?= session()->get('username') ?>! 👋</h1>
                    <p class="lead opacity-75 mb-0">Selamat datang di dashboard Miloo Shop. Temukan barang favoritmu hari ini!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Stat Cards -->
    <div class="card">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 45px; height: 45px; background: #e0e7ff; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; color: var(--dark);">Order Aktif</h3>
                <p style="font-size: 0.85rem; color: var(--secondary);">Kamu belum memiliki pesanan aktif.</p>
            </div>
        </div>
        <button class="btn btn-primary" style="width: 100%; justify-content: center;">
            <i class="fas fa-search"></i> Cari Produk
        </button>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 45px; height: 45px; background: #fef3c7; color: #d97706; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fas fa-heart"></i>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; color: var(--dark);">Wishlist</h3>
                <p style="font-size: 0.85rem; color: var(--secondary);">0 Item disimpan</p>
            </div>
        </div>
        <button class="btn btn-primary" style="width: 100%; justify-content: center; background: #f59e0b; border: none;">
            <i class="fas fa-plus"></i> Tambah Koleksi
        </button>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 45px; height: 45px; background: #dcfce7; color: #16a34a; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fas fa-store"></i>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; color: var(--dark);">Buka Toko?</h3>
                <p style="font-size: 0.85rem; color: var(--secondary);">Mulai berjualan sekarang!</p>
            </div>
        </div>
        <button class="btn btn-primary" style="width: 100%; justify-content: center; background: #10b981; border: none;">
            <i class="fas fa-rocket"></i> Jadi Penjual
        </button>
    </div>
</div>

<div class="card mt-4">
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--dark); margin-bottom: 1.5rem;">Rekomendasi Untukmu</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
        <!-- Placeholder for products -->
        <div style="text-align: center; padding: 2rem; border: 2px dashed #e2e8f0; border-radius: 12px; grid-column: 1 / -1;">
            <p style="color: var(--secondary);">Belum ada produk yang ditampilkan.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
