<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Miloo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --secondary: #64748b; --danger: #ef4444; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: #f1f5f9; color: var(--dark); padding-bottom: 50px; }
        
        .navbar { background: white; padding: 1rem 5%; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; }
        .logo { font-weight: 800; font-size: 1.5rem; text-decoration: none; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .logo-box { width: 32px; height: 32px; background: var(--primary); border-radius: 6px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; display: grid; grid-template-columns: 1fr 350px; gap: 2rem; }
        
        .cart-section { background: white; padding: 2rem; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
        .cart-header { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 2rem; }
        .cart-header h2 { font-weight: 800; font-size: 1.5rem; }
        
        .shop-group { margin-bottom: 3rem; }
        .shop-header { display: flex; align-items: center; gap: 0.8rem; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; margin-bottom: 1.5rem; }
        .shop-avatar { width: 32px; height: 32px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 0.9rem; border: 1px solid #e2e8f0; }
        .shop-name { font-weight: 700; color: #334155; }
        
        .cart-item { display: flex; gap: 1.5rem; margin-bottom: 1.5rem; align-items: center; position: relative; }
        .item-img { width: 100px; height: 100px; object-fit: cover; border-radius: 16px; border: 1px solid #f1f5f9; }
        .item-info { flex: 1; }
        .item-name { font-weight: 700; font-size: 1rem; color: #1e293b; margin-bottom: 0.4rem; }
        .item-price { font-weight: 800; color: var(--primary); font-size: 1.1rem; }
        
        .qty-controls { display: flex; align-items: center; background: #f8fafc; border-radius: 12px; padding: 2px; border: 1px solid #e2e8f0; }
        .qty-btn { width: 32px; height: 32px; border: none; background: transparent; cursor: pointer; color: var(--primary); font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .qty-val { width: 40px; text-align: center; font-weight: 800; color: #1e293b; }
        
        .summary-card { position: sticky; top: 100px; height: fit-content; background: white; padding: 2rem; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--secondary); font-size: 0.95rem; }
        .summary-total { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px dashed #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
        
        .btn-checkout { width: 100%; padding: 1.2rem; background: var(--primary); color: white; border: none; border-radius: 16px; font-weight: 800; font-size: 1.1rem; cursor: pointer; margin-top: 2rem; box-shadow: 0 10px 20px rgba(0, 170, 91, 0.2); transition: 0.3s; }
        .btn-checkout:hover { background: var(--primary-hover); transform: translateY(-3px); }
        
        .btn-remove { color: var(--danger); background: none; border: none; font-size: 0.85rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; margin-top: 0.8rem; }
        
        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
            .summary-card { position: static; }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="/" class="logo"><div class="logo-box">M</div> Miloo Shop</a>
        <div style="font-weight: 700; color: var(--secondary);">Keranjang Saya</div>
    </header>

    <div class="container">
        <div class="cart-section">
            <div class="cart-header">
                <h2>Belanjaan Kamu</h2>
                <div style="padding: 2px 10px; background: var(--primary-light); color: var(--primary); border-radius: 20px; font-size: 0.8rem; font-weight: 800;"><?= array_sum(array_map('count', $cartGroups)) ?> Produk</div>
            </div>

            <?php if (empty($cartGroups)): ?>
                <div style="text-align: center; padding: 5rem 0;">
                    <i class="fas fa-shopping-cart" style="font-size: 5rem; color: #f1f5f9; margin-bottom: 2rem;"></i>
                    <h3 style="color: #cbd5e1; font-weight: 800; font-size: 1.5rem;">Keranjang Masih Kosong</h3>
                    <p style="color: #94a3b8; margin-top: 0.5rem; margin-bottom: 2rem;">Yuk, cari gadget impianmu sekarang!</p>
                    <a href="/" style="padding: 1rem 2rem; background: var(--primary); color: white; text-decoration: none; border-radius: 12px; font-weight: 800;">Mulai Belanja</a>
                </div>
            <?php else: ?>
                <?php foreach ($cartGroups as $shopName => $items): ?>
                    <div class="shop-group">
                        <div class="shop-header">
                            <div class="shop-avatar"><i class="fas fa-store"></i></div>
                            <span class="shop-name"><?= $shopName ?></span>
                            <div style="margin-left: auto; width: 6px; height: 6px; background: #22c55e; border-radius: 50%;"></div>
                        </div>
                        <?php foreach ($items as $p): ?>
                            <div class="cart-item">
                                <img src="<?= $p['img'] ?: 'https://via.placeholder.com/300' ?>" class="item-img" alt="">
                                <div class="item-info">
                                    <p class="item-name"><?= $p['name'] ?></p>
                                    <p class="item-price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                                    <a href="/cart/delete/<?= $p['id'] ?>" class="btn-remove"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </div>
                                <div class="item-actions">
                                    <div class="qty-controls">
                                        <form action="/cart/update" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="action" value="minus">
                                            <button type="submit" class="qty-btn">-</button>
                                        </form>
                                        <div class="qty-val"><?= $p['qty'] ?></div>
                                        <form action="/cart/update" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="action" value="plus">
                                            <button type="submit" class="qty-btn">+</button>
                                        </form>
                                    </div>
                                    <div style="text-align: right; margin-top: 0.5rem; font-weight: 800; color: #1e293b; font-size: 0.85rem;">
                                        Subtotal: Rp <?= number_format($p['subtotal'], 0, ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="summary-card">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Ringkasan Belanja</h3>
            <div class="summary-row">
                <span>Total Harga</span>
                <span style="font-weight: 800; color: #1e293b;">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span>Total Diskon</span>
                <span style="color: var(--primary); font-weight: 700;">-Rp 0</span>
            </div>
            
            <div class="summary-total">
                <span style="font-weight: 700; color: var(--secondary);">Total Tagihan</span>
                <span style="font-weight: 800; font-size: 1.5rem; color: var(--primary);">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>

            <button class="btn-checkout" onclick="window.location.href='/checkout'">Beli (<?= array_sum(array_map('count', $cartGroups)) ?> Produk)</button>
            <p style="text-align: center; font-size: 0.75rem; color: var(--secondary); margin-top: 1.5rem;">Voucher bisa digunakan di halaman pembayaran.</p>
        </div>
    </div>
</body>
</html>
