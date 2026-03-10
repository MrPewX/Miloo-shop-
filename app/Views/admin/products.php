<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Moderasi Produk</h1>
    <p style="color: var(--secondary);">Pantau dan kelola seluruh produk yang terdaftar di marketplace.</p>
</div>

<div style="display: flex; flex-direction: column; gap: 3rem;">
    <?php foreach ($grouped_products as $shopName => $products): ?>
        <div class="shop-group">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 12px; border-left: 4px solid var(--primary);">
                <i class="fas fa-store" style="color: var(--primary); font-size: 1.2rem;"></i>
                <h2 style="font-size: 1.1rem; font-weight: 800; color: #1e293b;"><?= $shopName ?> <span style="font-weight: 500; font-size: 0.85rem; color: var(--secondary); margin-left: 0.5rem;">(<?= count($products) ?> Produk)</span></h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem;">
                <?php foreach ($products as $p): ?>
                <div style="border: 1px solid #eef2f6; border-radius: 16px; overflow: hidden; background: #fff; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                    <div style="height: 180px; background: url('<?= $p['foto_url'] ?: 'https://via.placeholder.com/300' ?>') center/cover; position: relative;">
                        <div style="position: absolute; bottom: 10px; left: 10px; background: rgba(0,0,0,0.6); color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem;">ID: #<?= $p['id'] ?></div>
                    </div>
                    <div style="padding: 1rem;">
                        <h4 style="margin-bottom: 0.5rem; font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem;"><?= $p['nama_produk'] ?></h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <p style="color: var(--primary); font-weight: 800; font-size: 0.95rem;">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                            <span style="font-size: 0.65rem; color: <?= $p['status'] == 'active' ? '#16a34a' : '#ef4444' ?>; font-weight: 800; text-transform: uppercase; background: <?= $p['status'] == 'active' ? '#dcfce7' : '#fee2e2' ?>; padding: 2px 6px; border-radius: 4px;"><?= $p['status'] ?></span>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                            <a href="/product/<?= $p['id'] ?>" class="btn" style="background: #f1f5f9; color: #475569; padding: 0.5rem; justify-content: center;"><i class="fas fa-eye"></i> Detail</a>
                            <button onclick="deleteProduct(<?= $p['id'] ?>)" class="btn" style="background: #fee2e2; color: #ef4444; padding: 0.5rem; justify-content: center;"><i class="fas fa-trash"></i> Hapus</button>
                            <?php if($p['status'] == 'active'): ?>
                                <button onclick="toggleProduct(<?= $p['id'] ?>, 'inactive')" class="btn" style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; grid-column: span 2; justify-content: center; font-size: 0.8rem;"><i class="fas fa-power-off"></i> Nonaktifkan</button>
                            <?php else: ?>
                                <button onclick="toggleProduct(<?= $p['id'] ?>, 'active')" class="btn" style="background: var(--primary-light); color: var(--primary); grid-column: span 2; justify-content: center; font-size: 0.8rem;"><i class="fas fa-check"></i> Aktifkan</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    
    <?php if (empty($grouped_products)): ?>
        <div style="text-align: center; padding: 5rem 0; background: white; border-radius: 20px;">
            <i class="fas fa-shopping-basket" style="font-size: 4rem; color: #e2e8f0; margin-bottom: 1rem;"></i>
            <p style="color: var(--secondary);">Tidak ada produk yang tersedia.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function deleteProduct(id) {
        if (confirm("Hapus produk ini secara permanen?")) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/delete-product/' + id;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function toggleProduct(id, status) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/update-product-data/' + id;
        
        const inputStatus = document.createElement('input');
        inputStatus.type = 'hidden';
        inputStatus.name = 'status';
        inputStatus.value = status;
        
        form.appendChild(inputStatus);
        document.body.appendChild(form);
        form.submit();
    }
</script>
<?= $this->endSection() ?>
