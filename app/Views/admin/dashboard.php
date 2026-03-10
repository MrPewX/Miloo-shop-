<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Dashboard Admin</h1>
    <p style="color: var(--secondary);">Overview statistik marketplace Miloo Shop hari ini.</p>
</div>

<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
    <div class="card" style="border-left: 4px solid var(--primary); display: flex; align-items: center; gap: 1.5rem;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-store"></i>
        </div>
        <div>
            <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Total Toko</div>
            <div style="font-size: 1.5rem; font-weight: 700;">124</div>
        </div>
    </div>
    
    <div class="card" style="border-left: 4px solid #10b981; display: flex; align-items: center; gap: 1.5rem;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div>
            <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Total Penjualan</div>
            <div style="font-size: 1.5rem; font-weight: 700;">Rp 12,4M</div>
        </div>
    </div>

    <div class="card" style="border-left: 4px solid #f59e0b; display: flex; align-items: center; gap: 1.5rem;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div style="font-size: 0.85rem; color: var(--secondary); font-weight: 500;">Total Pengguna</div>
            <div style="font-size: 1.5rem; font-weight: 700;">1,842</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">Toko Terbaru</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 1px solid #f1f5f9; color: var(--secondary); font-size: 0.85rem;">
                    <th style="padding: 1rem 0;">Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 1rem 0; font-weight: 500;">Elektronik Jaya</td>
                    <td>Budi Santoso</td>
                    <td><span style="background: #dcfce7; color: #15803d; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem;">Aktif</span></td>
                    <td><button class="btn btn-primary" style="padding: 0.3rem 0.7rem; font-size: 0.75rem;">Detail</button></td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 1rem 0; font-weight: 500;">Hijab Syari</td>
                    <td>Siti Aminah</td>
                    <td><span style="background: #dcfce7; color: #15803d; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem;">Aktif</span></td>
                    <td><button class="btn btn-primary" style="padding: 0.3rem 0.7rem; font-size: 0.75rem;">Detail</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">Log Aktivitas</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; gap: 1rem; font-size: 0.9rem;">
                <div style="min-width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-plus text-primary"></i>
                </div>
                <div>
                    <div style="font-weight: 600;">Produk Baru ditambahkan</div>
                    <div style="font-size: 0.8rem; color: var(--secondary);">Oleh Toko Hijab Syari • 5 menit yang lalu</div>
                </div>
            </div>
            <div style="display: flex; gap: 1rem; font-size: 0.9rem;">
                <div style="min-width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-plus text-primary"></i>
                </div>
                <div>
                    <div style="font-weight: 600;">Pengguna Baru Terdaftar</div>
                    <div style="font-size: 0.8rem; color: var(--secondary);">Andi Pratama • 12 menit yang lalu</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
