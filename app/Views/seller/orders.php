<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Pesanan Masuk</h1>
    <p style="color: var(--secondary);">Kelola dan proses pesanan dari pelanggan Anda.</p>
</div>

<div class="card" style="padding: 1.5rem;">
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
        <button style="padding: 0.6rem 1.2rem; border-radius: 10px; border: none; background: var(--primary); color: white; font-weight: 700;">Semua</button>
        <button style="padding: 0.6rem 1.2rem; border-radius: 10px; border: 1px solid #e2e8f0; background: white; font-weight: 600; color: var(--secondary);">Perlu Diproses</button>
        <button style="padding: 0.6rem 1.2rem; border-radius: 10px; border: 1px solid #e2e8f0; background: white; font-weight: 600; color: var(--secondary);">Dikirim</button>
        <button style="padding: 0.6rem 1.2rem; border-radius: 10px; border: 1px solid #e2e8f0; background: white; font-weight: 600; color: var(--secondary);">Selesai</button>
    </div>

    <?php if (empty($orders)): ?>
        <div style="text-align: center; padding: 5rem 0;">
            <div style="width: 100px; height: 100px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-shopping-bag" style="font-size: 2.5rem; color: #e2e8f0;"></i>
            </div>
            <h3 style="font-weight: 800; color: #1e293b; margin-bottom: 0.5rem;">Belum Ada Pesanan</h3>
            <p style="color: var(--secondary); font-size: 0.95rem;">Pesanan baru dari pelanggan akan muncul di sini.</p>
        </div>
    <?php else: ?>
        <!-- Order List Table (to be implemented with real data) -->
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
