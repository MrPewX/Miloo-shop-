<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Notifikasi Admin</h1>
    <p style="color: var(--secondary);">Pesan dan teguran resmi dari tim moderator Miloo Tech.</p>
</div>

<div class="card" style="padding: 1.5rem;">
    <?php if (empty($notes)): ?>
        <div style="text-align: center; padding: 4rem;">
            <i class="fas fa-bell-slash" style="font-size: 4rem; color: #f1f5f9; margin-bottom: 1.5rem;"></i>
            <h3>Belum Ada Notifikasi</h3>
            <p style="color: var(--secondary);">Toko Anda dalam kondisi baik dan tidak memiliki teguran.</p>
        </div>
    <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <?php foreach ($notes as $note): ?>
                <div style="padding: 1.5rem; border-radius: 16px; border: 1px solid #fee2e2; background: #fff1f2; position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                        <span style="font-weight: 800; color: #b91c1c; font-size: 0.85rem; text-transform: uppercase;"><i class="fas fa-exclamation-triangle"></i> Teguran Penting</span>
                        <span style="font-size: 0.75rem; color: #fca5a5; font-weight: 700;"><?= date('d M Y, H:i', strtotime($note['created_at'])) ?></span>
                    </div>
                    <p style="color: #7f1d1d; line-height: 1.6; font-size: 0.95rem; font-weight: 500;"><?= $note['note'] ?></p>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #fecaca; display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #991b1b; font-weight: 700;">
                        <i class="fas fa-info-circle"></i> Segera lakukan perbaikan untuk menghindari pemblokiran permanen.
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
