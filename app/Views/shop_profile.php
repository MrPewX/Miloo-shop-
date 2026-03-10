<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $shop['nama_toko'] ?> - Miloo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --light: #f8fafc; --secondary: #64748b; --danger: #ef4444; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: #f1f5f9; color: var(--dark); }
        
        .header { background: white; padding: 1rem 5%; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .logo { font-weight: 800; font-size: 1.5rem; text-decoration: none; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .logo-box { width: 32px; height: 32px; background: var(--primary); border-radius: 6px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }
        .cart-btn { position: relative; color: var(--secondary); font-size: 1.4rem; text-decoration: none; }
        .cart-badge { position: absolute; top: -8px; right: -10px; background: #ef4444; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 12px; font-weight: 700; border: 2px solid white; }

        .shop-banner { background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=2070'); background-size: cover; background-position: center; height: 250px; position: relative; }
        .shop-profile-card { max-width: 1200px; margin: -60px auto 2rem; background: white; border-radius: 20px; padding: 2rem; display: flex; align-items: center; gap: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; z-index: 10; border: 1px solid #e2e8f0; }
        .shop-avatar { width: 120px; height: 120px; border-radius: 50%; background: #f8fafc; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: var(--primary); }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: grid; grid-template-columns: 280px 1fr; gap: 2rem; }
        
        .sidebar-section { background: white; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; }
        .sidebar-title { font-weight: 800; font-size: 0.95rem; margin-bottom: 1.2rem; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; }
        .cat-link { display: block; padding: 0.8rem 1rem; text-decoration: none; color: var(--secondary); border-radius: 12px; transition: 0.2s; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .cat-link:hover { background: var(--primary-light); color: var(--primary); padding-left: 1.5rem; }

        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; border: 1px solid #eef2f6; transition: 0.3s; display: flex; flex-direction: column; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .product-img { width: 100%; aspect-ratio: 1; object-fit: cover; }
        .product-info { padding: 1rem; flex: 1; display: flex; flex-direction: column; }
        .product-name { font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.4rem; }
        .product-price { color: var(--primary); font-weight: 800; font-size: 1.1rem; margin-bottom: 0.8rem; }
        
        .btn-action { padding: 0.5rem; border-radius: 10px; border: none; font-weight: 700; cursor: pointer; transition: 0.2s; }
        .btn-cart { background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-light); }
        .btn-buy { background: var(--primary); color: white; }

        .admin-panel { background: #fff1f2; border: 1px solid #fecaca; border-radius: 12px; padding: 1rem; margin-top: 1rem; }
        .admin-btn { width: 100%; padding: 0.5rem; margin-bottom: 0.5rem; border-radius: 8px; border: none; font-size: 0.8rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .shop-profile-card { flex-direction: column; text-align: center; margin-top: -80px; }
        }
    </style>
</head>
<body>
    <header class="header">
        <div style="display: flex; align-items: center; gap: 2rem;">
            <a href="javascript:history.back()" style="text-decoration: none; color: var(--secondary); font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="/" class="logo"><div class="logo-box">M</div> Miloo Shop</a>
        </div>
        <div class="nav-actions">
            <?php $cartCount = session()->get('cart') ? count(session()->get('cart')) : 0; ?>
            <a href="/cart" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge"><?= $cartCount ?></span>
            </a>
            <div style="width: 1px; height: 30px; background: #e2e8f0;"></div>
            <?php if (session()->get('logged_in')): ?>
                <span style="font-weight: 700; color: var(--dark);"><?= session()->get('username') ?></span>
            <?php else: ?>
                <a href="/login" style="text-decoration: none; color: var(--primary); font-weight: 700;">Masuk</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="shop-banner"></div>
    
    <div class="shop-profile-card">
        <div class="shop-avatar"><i class="fas fa-store"></i></div>
        <div style="flex:1;">
            <h1 style="font-size: 2rem; font-weight: 800; margin-bottom: 0.4rem;"><?= $shop['nama_toko'] ?></h1>
            <p style="color: var(--secondary); margin-bottom: 1rem; font-size: 1rem; max-width: 600px;"><?= $shop['deskripsi_toko'] ?></p>
            <div style="display: flex; gap: 1.5rem; align-items: center; color: var(--secondary); font-size: 0.9rem;">
                <span><i class="fas fa-box" style="color: var(--primary);"></i> <b><?= count($products) ?></b> Produk</span>
                <span><i class="fas fa-star" style="color: #fbbf24;"></i> <b>4.9</b> Penilaian</span>
                <span><i class="fas fa-user-friends" style="color: #3b82f6;"></i> <b>1.2k</b> Pengikut</span>
            </div>
        </div>
        <div style="display: flex; gap: 1rem;">
            <button onclick="handleFollow(this)" id="follow-btn" style="padding: 0.8rem 2.5rem; border-radius: 12px; background: var(--primary); color: white; border: none; font-weight: 800; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(0, 170, 91, 0.2);">Follow</button>
            <button style="padding: 0.8rem 1.5rem; border-radius: 12px; background: white; color: var(--primary); border: 2px solid var(--primary); font-weight: 800; cursor: pointer;"><i class="fas fa-comment"></i> Chat</button>
        </div>
    </div>

    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-section">
                <p class="sidebar-title">Kategori Toko</p>
                <?php 
                    // Get categories from products
                    $shopCats = [];
                    $db = \Config\Database::connect();
                    $res = $db->table('products')
                              ->select('categories.nama_kategori, categories.id')
                              ->join('categories', 'categories.id = products.category_id')
                              ->where('shop_id', $shop['id'])
                              ->distinct()
                              ->get()
                              ->getResultArray();
                    foreach($res as $c):
                ?>
                    <a href="#" class="cat-link"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 0.5rem;"></i> <?= $c['nama_kategori'] ?></a>
                <?php endforeach; ?>
                <a href="#" class="cat-link" style="border-top: 1px solid #f1f5f9; margin-top: 1rem; padding-top: 1rem; color: var(--primary);">Lihat Semua Produk</a>
            </div>

            <?php if (session()->get('role') === 'admin'): ?>
                <div class="sidebar-section" style="background: #fff1f2; border: 1px solid #fecaca;">
                    <p class="sidebar-title" style="color: #b91c1c;">Admin Actions</p>
                    <button onclick="adminAction('block_shop', <?= $shop['id'] ?>)" class="admin-btn" style="background: #ef4444; color: white;"><i class="fas fa-ban"></i> Blokir Toko</button>
                    <button onclick="adminAction('warn_shop', <?= $shop['id'] ?>)" class="admin-btn" style="background: #f59e0b; color: white;"><i class="fas fa-exclamation-triangle"></i> Kirim Teguran</button>
                </div>
            <?php endif; ?>
        </aside>

        <section class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
                <h2 style="font-weight: 800; font-size: 1.3rem;">Semua Produk</h2>
                <div style="display: flex; gap: 0.5rem;">
                    <div style="padding: 0.5rem 1rem; background: var(--primary-light); color: var(--primary); border-radius: 8px; font-weight: 700; font-size: 0.85rem;">Terbaru</div>
                    <div style="padding: 0.5rem 1rem; background: white; border: 1px solid #e2e8f0; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: var(--secondary);">Terlaris</div>
                </div>
            </div>

            <div class="product-grid">
                <?php foreach ($products as $p): 
                    $isInactive = $p['status'] === 'inactive';
                ?>
                    <div class="product-card" onclick="window.location.href='/product/<?= $p['id'] ?>'" style="cursor: pointer; <?= $isInactive ? 'opacity: 0.6; filter: grayscale(1);' : '' ?>">
                        <div style="position: relative;">
                            <img src="<?= $p['img'] ?: 'https://via.placeholder.com/300' ?>" class="product-img" alt="">
                            <?php if ($isInactive): ?>
                                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4); color:white; display:flex; align-items:center; justify-content:center; font-weight:800; font-size: 0.8rem;">DINONAKTIFKAN</div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <p class="product-name"><?= $p['name'] ?></p>
                            <p class="product-price"><?= $p['price'] ?></p>
                            
                            <div style="display: grid; grid-template-columns: 1fr 2.5fr; gap: 0.5rem; margin-top: auto;" onclick="event.stopPropagation()">
                                <?php if ($isInactive): ?>
                                    <button class="btn-action" disabled style="background: #e2e8f0; color: #94a3b8; grid-column: span 2;">Stok Kosong</button>
                                <?php else: ?>
                                    <button class="btn-action btn-cart" onclick="handleCart(<?= $p['id'] ?>)"><i class="fas fa-cart-plus"></i></button>
                                    <button class="btn-action btn-buy" onclick="handleBuyNow(<?= $p['id'] ?>)">Beli Langsung</button>
                                <?php endif; ?>
                            </div>

                            <?php if (session()->get('role') === 'admin'): ?>
                                <button onclick="event.stopPropagation(); adminAction('delete_product', <?= $p['id'] ?>)" style="width: 100%; margin-top: 0.8rem; background: #f1f5f9; color: #475569; border: none; padding: 0.4rem; border-radius: 8px; font-size: 0.75rem; font-weight: 700; cursor: pointer;"><i class="fas fa-trash"></i> Hapus Produk</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <script>
        function handleFollow(btn) {
            if (btn.innerText === "Follow") {
                btn.innerText = "Following";
                btn.style.background = "#eff6ff";
                btn.style.color = "#2563eb";
            } else {
                btn.innerText = "Follow";
                btn.style.background = "var(--primary)";
                btn.style.color = "white";
            }
        }

        function handleCart(id) {
            <?php if (!session()->get('logged_in')): ?>
                alert("Silakan login."); window.location.href = "/login"; return;
            <?php endif; ?>
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/cart/add';
            const p = document.createElement('input'); p.type = 'hidden'; p.name = 'product_id'; p.value = id;
            const q = document.createElement('input'); q.type = 'hidden'; q.name = 'qty'; q.value = 1;
            form.appendChild(p); form.appendChild(q);
            document.body.appendChild(form);
            form.submit();
        }

        function handleBuyNow(id) {
            window.location.href = "/checkout?id=" + id + "&qty=1";
        }

        function adminAction(type, id) {
            let url = "";
            let method = "POST";

            if (type === 'block_shop') {
                if (confirm("Blokir toko ini?")) url = "/admin/block-shop/" + id;
            } else if (type === 'warn_shop') {
                let n = prompt("Alasan teguran:");
                if (n) {
                    url = "/admin/warn-shop/" + id + "?note=" + encodeURIComponent(n);
                }
            } else if (type === 'delete_product') {
                if (confirm("Hapus produk?")) url = "/admin/delete-product/" + id;
            }

            if (url) {
                const form = document.createElement('form');
                form.method = method;
                form.action = url;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
