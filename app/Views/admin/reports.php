<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Laporan Penjualan</h1>
    <p style="color: var(--secondary);">Laporan performa marketplace secara keseluruhan.</p>
</div>

<div class="card">
    <div style="background: #f8fafc; border: 2px dashed #e2e8f0; height: 300px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">
        <div style="text-align: center;">
            <i class="fas fa-chart-bar" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
            <p style="color: #64748b;">Grafik Laporan Sedang Diproses...</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
