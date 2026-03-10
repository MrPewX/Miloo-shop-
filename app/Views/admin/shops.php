<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Daftar Toko</h1>
    <p style="color: var(--secondary);">Kelola seluruh toko yang terdaftar di marketplace Miloo Tech.</p>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h3 style="font-size: 1.1rem;">Semua Toko</h3>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--secondary);">
                <i class="fas fa-sort-amount-down"></i> Urutan:
                <select onchange="window.location.href='?sort='+this.value" style="padding: 0.4rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-weight: 600; color: var(--dark); cursor: pointer;">
                    <option value="id_desc" <?= $current_sort == 'id_desc' ? 'selected' : '' ?>>Terbaru Mendaftar</option>
                    <option value="name_asc" <?= $current_sort == 'name_asc' ? 'selected' : '' ?>>Nama (A-Z)</option>
                    <option value="name_desc" <?= $current_sort == 'name_desc' ? 'selected' : '' ?>>Nama (Z-A)</option>
                    <option value="date_asc" <?= $current_sort == 'date_asc' ? 'selected' : '' ?>>Lama Mendaftar</option>
                </select>
            </div>
            <input type="text" placeholder="Cari toko..." style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.85rem;">
        </div>
    </div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; background: #f8fafc; border-bottom: 1px solid #f1f5f9; color: var(--secondary); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="padding: 1rem 1.5rem;">Info Toko</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
                <th style="text-align: right; padding-right: 1.5rem;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shops as $shop): ?>
            <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;">
                <td style="padding: 1.2rem 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                            <?= strtoupper(substr($shop['nama_toko'], 0, 1)) ?>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #1e293b;"><?= $shop['nama_toko'] ?></div>
                            <div style="font-size: 0.75rem; color: var(--secondary);">ID Toko: #<?= $shop['id'] ?> • Pemilik: #<?= $shop['user_id'] ?></div>
                        </div>
                    </div>
                </td>
                <td>
                    <span style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;
                        <?php if($shop['status'] == 'active'): ?>
                            background: #dcfce7; color: #15803d;
                        <?php else: ?>
                            background: #fee2e2; color: #b91c1c;
                        <?php endif; ?>
                    ">
                        <?= $shop['status'] ?>
                    </span>
                </td>
                <td style="font-size: 0.85rem; color: var(--secondary);"><?= date('d M Y', strtotime($shop['created_at'])) ?></td>
                <td style="text-align: right; padding-right: 1.5rem;">
                    <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                        <a href="/shop/<?= $shop['id'] ?>" class="btn" style="background: #f1f5f9; color: #475569; padding: 0.5rem;" title="Lihat Toko"><i class="fas fa-eye"></i></a>
                        <button onclick="warnShop(<?= $shop['id'] ?>)" class="btn" style="background: #fef3c7; color: #d97706; padding: 0.5rem;" title="Beri Teguran"><i class="fas fa-exclamation-triangle"></i></button>
                        <?php if($shop['status'] === 'active'): ?>
                            <button onclick="blockShop(<?= $shop['id'] ?>)" class="btn" style="background: #fee2e2; color: #ef4444; padding: 0.5rem;" title="Blokir Toko"><i class="fas fa-ban"></i></button>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function blockShop(id) {
        if (confirm("Apakah Anda yakin ingin MEMBLOKIR toko ini? Semua produknya akan dinonaktifkan.")) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/block-shop/' + id;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function warnShop(id) {
        const note = prompt("Berikan alasan teguran untuk pemilik toko:");
        if (note) {
            window.location.href = "/admin/warn-shop/" + id + "?note=" + encodeURIComponent(note);
        }
    }
</script>
<?= $this->endSection() ?>
