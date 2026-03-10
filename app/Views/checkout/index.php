<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Miloo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --secondary: #64748b; --danger: #ef4444; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #f1f5f9; color: var(--dark); padding-bottom: 50px; }
        
        .navbar { background: white; padding: 1rem 5%; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; }
        .logo { font-weight: 800; font-size: 1.5rem; text-decoration: none; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .logo-box { width: 32px; height: 32px; background: var(--primary); border-radius: 6px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        .container { max-width: 1000px; margin: 2rem auto; padding: 0 1rem; display: grid; grid-template-columns: 1fr 380px; gap: 2rem; }
        
        .card { background: white; padding: 2rem; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 1.5rem; }
        h2, h3 { font-weight: 800; color: #1e293b; }
        h2 { margin-bottom: 2rem; font-size: 1.8rem; }
        
        .section-title { font-size: 1.1rem; font-weight: 800; margin-bottom: 1.5rem; padding-bottom: 0.8rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.8rem; }
        
        .address-box { padding: 1.2rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; position: relative; }
        .address-tag { position: absolute; top: 1rem; right: 1rem; background: var(--primary-light); color: var(--primary); font-size: 0.7rem; font-weight: 800; padding: 2px 8px; border-radius: 4px; }

        .item-list { margin-top: 1rem; }
        .checkout-item { display: flex; gap: 1.2rem; padding: 1.2rem 0; border-bottom: 1px solid #f1f5f9; }
        .checkout-item:last-child { border-bottom: none; }
        .item-img { width: 80px; height: 80px; object-fit: cover; border-radius: 12px; border: 1px solid #f1f5f9; }
        .item-details { flex: 1; }
        .item-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 0.3rem; color: #334155; }
        .item-qty { font-size: 0.85rem; color: var(--secondary); margin-bottom: 0.5rem; }
        .item-price { font-weight: 800; color: var(--primary); }

        .payment-option { display: flex; align-items: center; gap: 1rem; padding: 1.2rem; border: 2px solid #e2e8f0; border-radius: 16px; cursor: pointer; transition: 0.2s; margin-bottom: 1rem; }
        .payment-option:hover { border-color: var(--primary-light); background: #fbfdfc; }
        .payment-option.active { border-color: var(--primary); background: var(--primary-light); }
        .payment-icon { width: 40px; height: 40px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }

        .summary-card { position: sticky; top: 100px; height: fit-content; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.95rem; color: var(--secondary); }
        .summary-total { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        
        .btn-pay { width: 100%; padding: 1.2rem; background: var(--primary); color: white; border: none; border-radius: 16px; font-weight: 800; font-size: 1.1rem; cursor: pointer; margin-top: 2rem; box-shadow: 0 8px 20px rgba(0, 170, 91, 0.2); transition: 0.3s; }
        .btn-pay:hover { background: var(--primary-hover); transform: translateY(-3px); }

        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
            .summary-card { position: static; }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="/" class="logo"><div class="logo-box">M</div> Miloo Shop</a>
        <div style="font-weight: 700; color: var(--secondary);">Proses Checkout</div>
    </header>

    <div class="container">
        <div class="main-checkout">
            <h2>Pengiriman & Pembayaran</h2>
            
            <div class="card">
                <div class="section-title"><i class="fas fa-map-marker-alt" style="color: var(--danger);"></i> Alamat Pengiriman</div>
                <div class="address-box">
                    <span class="address-tag">ALAMAT UTAMA</span>
                    <p style="font-weight: 800; font-size: 1rem; margin-bottom: 0.3rem;"><?= session()->get('username') ?></p>
                    <p style="color: var(--secondary); font-size: 0.9rem; margin-bottom: 0.2rem;">+62 812-3456-7890</p>
                    <p style="color: #475569; font-size: 0.9rem; line-height: 1.5;">Kav. 12, Menara Tech Hub, Jl. Jendral Sudirman No. 45<br>Kebayoran Baru, Jakarta Selatan, 12190</p>
                    <button style="margin-top: 1rem; background: none; border: 1px solid #cbd5e1; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.8rem; font-weight: 700; color: #475569; cursor: pointer;">Pilih Alamat Lain</button>
                </div>
            </div>

            <div class="card">
                <div class="section-title"><i class="fas fa-shopping-bag" style="color: var(--primary);"></i> Pesanan Anda</div>
                <div class="item-list">
                    <?php foreach($checkout_items as $item): ?>
                    <div class="checkout-item">
                        <img src="<?= $item['img'] ?>" class="item-img" alt="">
                        <div class="item-details">
                            <p class="item-name"><?= $item['name'] ?></p>
                            <p class="item-qty"><?= $item['qty'] ?> Unit</p>
                            <p class="item-price">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card">
                <div class="section-title"><i class="fas fa-credit-card" style="color: #6366f1;"></i> Metode Pembayaran</div>
                
                <div class="payment-option active">
                    <div class="payment-icon"><i class="fas fa-wallet" style="color: #2563eb;"></i></div>
                    <div style="flex: 1;">
                        <p style="font-weight: 700; font-size: 0.95rem;">Virtual Account / QRIS</p>
                        <p style="font-size: 0.8rem; color: var(--secondary);">Aktivasi instan, verifikasi otomatis</p>
                    </div>
                    <i class="fas fa-check-circle" style="color: var(--primary);"></i>
                </div>

                <div class="payment-option">
                    <div class="payment-icon"><i class="fas fa-university" style="color: #64748b;"></i></div>
                    <div style="flex: 1;">
                        <p style="font-weight: 700; font-size: 0.95rem;">Transfer Bank Manual</p>
                        <p style="font-size: 0.8rem; color: var(--secondary);">Verifikasi dalam 1x24 jam</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="summary-card card">
            <h3 style="margin-bottom: 2rem;">Ringkasan Belanja</h3>
            <div class="summary-row">
                <span>Total Harga (<?= count($checkout_items) ?> Barang)</span>
                <span style="font-weight: 600; color: #1e293b;">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span>Total Ongkos Kirim (Asuransi)</span>
                <span style="font-weight: 600; color: #1e293b;">Rp <?= number_format($shipping, 0, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span>Biaya Layanan</span>
                <span style="font-weight: 600; color: #1e293b;">Rp 1.000</span>
            </div>
            
            <div class="summary-total">
                <span style="font-weight: 700; color: var(--secondary);">Total Tagihan</span>
                <span style="font-weight: 800; font-size: 1.5rem; color: var(--primary);">Rp <?= number_format($grand_total + 1000, 0, ',', '.') ?></span>
            </div>

            <button class="btn-pay" onclick="window.location.href='/checkout/process'">Bayar Sekarang</button>
            <p style="text-align: center; font-size: 0.75rem; color: var(--secondary); margin-top: 1rem;">Dengan menekan tombol, Anda menyetujui <a href="#" style="color: var(--primary); text-decoration: none;">Syarat & Ketentuan</a></p>
        </div>
    </div>
</body>
</html>
