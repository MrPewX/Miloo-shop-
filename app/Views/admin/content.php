<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Manajemen Konten</h1>
    <p style="color: var(--secondary);">Kelola banner banner promo, kategori, dan teks di halaman depan.</p>
</div>

<div class="grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
    <div class="card">
        <h3>Banner Slider</h3>
        <p style="margin-bottom: 1rem; color: var(--secondary);">Update gambar dan promo di header utama.</p>
        <button class="btn btn-primary">Kelola Banner</button>
    </div>
    <div class="card">
        <h3>Daftar Kategori</h3>
        <p style="margin-bottom: 1rem; color: var(--secondary);">Tambah atau hapus kategori produk.</p>
        <button class="btn btn-primary">Kelola Kategori</button>
    </div>
</div>
<?= $this->endSection() ?>
