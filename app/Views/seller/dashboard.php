<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Dashboard Penjual</h1>
        <p style="color: var(--secondary);">Selamat datang di Seller Center, <strong><?= $shop['nama_toko'] ?></strong>!</p>
    </div>
    <a href="/shop/<?= $shop['id'] ?>" class="btn btn-primary" style="background: var(--primary); padding: 0.8rem 1.5rem; display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
        <i class="fas fa-external-link-alt"></i> Masuk Toko Saya
    </a>
</div>

<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
    <div class="card" style="border-left: 4px solid var(--primary);">
        <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Pesanan Baru</div>
        <div style="font-size: 1.8rem; font-weight: 700; margin-top: 0.5rem;">12</div>
    </div>
    
    <div class="card" style="border-left: 4px solid #10b981;">
        <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Pendapatan Bulan Ini</div>
        <div style="font-size: 1.8rem; font-weight: 700; margin-top: 0.5rem;">Rp 4,250,000</div>
    </div>

    <div class="card" style="border-left: 4px solid #f59e0b;">
        <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Produk Aktif</div>
        <div style="font-size: 1.8rem; font-weight: 700; margin-top: 0.5rem;">48</div>
    </div>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="font-weight: 600;">Produk Terpopuler</h3>
        <a href="/seller/products" class="btn btn-primary" style="font-size: 0.85rem; padding: 0.5rem 1rem;">Lihat Semua</a>
    </div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 1px solid #f1f5f9; color: var(--secondary); font-size: 0.85rem;">
                <th style="padding: 1rem 0;">Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Terjual</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 1rem 0; font-weight: 500;">Smartphone X Pro 256GB</td>
                <td>Rp 8,500,000</td>
                <td>15</td>
                <td>42</td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 1rem 0; font-weight: 500;">Wireless Earbuds Pro</td>
                <td>Rp 1,200,000</td>
                <td>30</td>
                <td>28</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card" style="background: #fffbeb; border: 1px solid #fef3c7;">
    <h3 style="color: #92400e; font-weight: 600; margin-bottom: 1rem;">
        <i class="fas fa-bullhorn" style="margin-right: 0.5rem;"></i> Catatan Admin
    </h3>
    <?php if (empty($notes)) : ?>
        <p style="color: #b45309; font-size: 0.9rem;">Tidak ada catatan dari admin.</p>
    <?php else : ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($notes as $note) : ?>
                <li style="margin-bottom: 0.8rem; padding-bottom: 0.8rem; border-bottom: 1px solid #fef3c7;">
                    <p style="color: #b45309; font-size: 0.9rem; font-weight: 500;"><?= $note['note'] ?></p>
                    <small style="color: #d97706;"><?= date('d M Y H:i', strtotime($note['created_at'])) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
