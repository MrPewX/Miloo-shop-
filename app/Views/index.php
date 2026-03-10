<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miloo Tech Hub - Gadget & PC Components Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --light: #f8fafc; --secondary: #64748b; --danger: #ef4444; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: #f1f5f9; color: var(--dark); overflow-x: hidden; }
        
        /* Navbar */
        .header { background: white; padding: 1rem 5%; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .logo { font-weight: 800; font-size: 1.8rem; text-decoration: none; color: var(--primary); display: flex; align-items: center; gap: 0.6rem; }
        .logo-box { width: 36px; height: 36px; background: var(--primary); border-radius: 8px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; box-shadow: 0 4px 8px rgba(0, 170, 91, 0.2); }
        
        .search-container { flex: 1; max-width: 600px; margin: 0 2rem; position: relative; }
        .search-input { width: 100%; padding: 0.8rem 1rem 0.8rem 3rem; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; font-size: 0.95rem; transition: 0.3s; }
        .search-input:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(0, 170, 91, 0.1); }
        .search-icon { position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--secondary); font-size: 1rem; }

        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }
        .cart-btn { position: relative; color: var(--secondary); font-size: 1.4rem; text-decoration: none; transition: 0.2s; }
        .cart-btn:hover { color: var(--primary); transform: translateY(-2px); }
        .cart-badge { position: absolute; top: -8px; right: -10px; background: #ef4444; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 12px; font-weight: 700; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }

        .user-menu { position: relative; cursor: pointer; display: flex; align-items: center; gap: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 50px; transition: 0.2s; }
        .user-menu:hover { background: #f1f5f9; }
        .dropdown-content { position: absolute; top: 110%; right: 0; background: white; min-width: 240px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); display: none; overflow: hidden; border: 1px solid #f1f5f9; }
        .dropdown-content.show { display: block; animation: dropdownSlide 0.3s ease; }
        @keyframes dropdownSlide { from { opacity:0; transform: translateY(-10px); } to { opacity:1; transform: translateY(0); } }
        .dropdown-item { padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--dark); font-weight: 500; font-size: 0.9rem; transition: 0.2s; }
        .dropdown-item:hover { background: #f8fafc; color: var(--primary); padding-left: 1.8rem; }
        .dropdown-divider { height: 1px; background: #f1f5f9; margin: 0.4rem 0; }

        .content-container { max-width: 1400px; margin: 0 auto; padding: 2rem 5%; }
        
        .hero-banner { background: linear-gradient(135deg, #00AA5B, #008f4c); border-radius: 20px; padding: 3rem; color: white; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 170, 91, 0.2); margin-bottom: 2rem; }
        .hero-banner::after { content: ''; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; }

        /* Category Slider */
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .section-title { font-size: 1.3rem; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 0.6rem; }
        .section-title::before { content: ''; width: 6px; height: 24px; background: var(--primary); border-radius: 4px; }
        
        .category-wrapper { position: relative; background: white; padding: 1.5rem; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; margin-bottom: 3rem; }
        .category-slider { display: flex; gap: 1rem; overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; padding-bottom: 0.5rem; }
        .category-slider::-webkit-scrollbar { display: none; }
        
        .category-card { flex: 0 0 calc(12.5% - 0.9rem); min-width: 120px; background: #f8fafc; border-radius: 16px; padding: 1rem; text-align: center; transition: 0.3s; cursor: pointer; border: 2px solid transparent; }
        .category-card:hover { transform: translateY(-5px); background: white; box-shadow: 0 8px 20px rgba(0,0,0,0.08); border-color: var(--primary-light); }
        .category-card.active { border-color: var(--primary); background: var(--primary-light); }
        .category-icon { margin-bottom: 0.8rem; display: flex; justify-content: center; align-items: center; height: 48px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        .category-icon img { height: 100%; width: auto; object-fit: contain; }
        .category-icon i, .category-icon span { font-size: 2.2rem; }
        .category-name { font-size: 0.85rem; font-weight: 700; color: var(--dark); line-height: 1.2; }

        .slider-btn { position: absolute; top: 50%; transform: translateY(-50%); width: 36px; height: 36px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.15); cursor: pointer; z-index: 10; border: none; font-size: 0.8rem; color: var(--secondary); }
        .slider-btn:hover { color: var(--primary); }
        .slider-btn.prev { left: -18px; }
        .slider-btn.next { right: -18px; }

        /* Product Grid */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; transition: 0.3s; border: 1px solid #eef2f6; display: flex; flex-direction: column; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .product-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); border-color: var(--primary-light); }
        .product-img { width: 100%; aspect-ratio: 1; position: relative; overflow: hidden; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .product-card:hover .product-img img { transform: scale(1.1); }
        
        .product-info { padding: 1.2rem; flex: 1; display: flex; flex-direction: column; }
        .product-name { font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 0.6rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem; }
        .product-price { font-size: 1.15rem; font-weight: 800; color: var(--primary); margin-bottom: 0.8rem; }
        .product-meta { font-size: 0.75rem; color: var(--secondary); display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.8rem; }
        .product-rating { display: flex; align-items: center; gap: 0.3rem; font-size: 0.8rem; font-weight: 700; color: #1e293b; background: #fef3c7; padding: 2px 8px; border-radius: 6px; }

        .btn-buy { padding: 0.6rem 1rem; border: none; border-radius: 10px; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: 0.2s; }
        .btn-buy.primary { background: var(--primary); color: white; }
        .btn-buy.primary:hover { background: var(--primary-hover); }
        .btn-buy.ghost { border: 2px solid var(--primary); color: var(--primary); background: transparent; }
        .btn-buy.ghost:hover { background: var(--primary-light); }

        /* Admin Action Box */
        .admin-box { background: #fff1f2; border: 1px solid #fecaca; padding: 1.5rem; border-radius: 20px; margin-bottom: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; align-items: flex-end; }
        .admin-input { background: white; border: 1px solid #fca5a5; padding: 0.6rem 1rem; border-radius: 10px; font-size: 0.9rem; }
        
        .admin-tools { transition: 0.3s; }
        .admin-btn { transition: 0.2s; display: flex; align-items: center; justify-content: center; gap: 0.4rem; }
        .admin-btn:hover { filter: brightness(0.9); transform: scale(1.02); }
        .admin-btn:active { transform: scale(0.98); }

        @media (max-width: 768px) {
            .header { padding: 0.8rem 3%; }
            .search-container { margin: 0 0.5rem; }
            .hero-banner { padding: 2rem; }
            .category-card { flex: 0 0 calc(25% - 0.9rem); }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="/" class="logo">
            <div class="logo-box">M</div> Miloo Shop
        </a>

        <div class="search-container">
            <form action="/" method="GET">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="q" class="search-input" placeholder="Cari Part PC, Laptop, atau spesifikasi..." value="<?= esc($searchQuery ?? '') ?>">
            </form>
        </div>

        <div class="nav-actions">
            <?php 
                $cart = session()->get('cart') ?: [];
                $cartCount = count($cart);
            ?>
            <a href="/cart" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge"><?= $cartCount ?></span>
            </a>
            <div style="width: 1px; height: 30px; background: #e2e8f0;"></div>
            
            <?php if (session()->get('logged_in')): ?>
                <div class="user-menu" id="userMenu">
                    <div style="text-align: right; display: none; display: md-block;">
                        <div style="font-size: 0.85rem; font-weight: 800;"><?= session()->get('username') ?></div>
                        <div style="font-size: 0.7rem; color: var(--secondary); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;"><?= session()->get('role') ?></div>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800; border: 2px solid white; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                        <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                    </div>
                    
                    <div class="dropdown-content" id="profileDropdown">
                        <div style="padding: 1.2rem; background: var(--primary-light);">
                            <p style="font-weight: 800; font-size: 0.95rem; color: var(--primary);">Halo, <?= session()->get('username') ?>!</p>
                            <p style="font-size: 0.75rem; color: var(--secondary);"><?= session()->get('email') ?></p>
                        </div>
                        <a href="/dashboard" class="dropdown-item"><i class="fas fa-desktop"></i> Dashboard</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-shopping-bag"></i> Transaksi Saya</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-heart"></i> Wishlist</a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/login" style="text-decoration: none; font-weight: 700; color: var(--primary);">Masuk</a>
                <a href="/register" style="padding: 0.5rem 1.2rem; background: var(--primary); color: white; border-radius: 10px; text-decoration: none; font-weight: 700;">Daftar</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="content-container">
        <!-- Dashboard Greeting -->
        <div class="hero-banner">
            <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem;">Upgrade Teknologimu</h1>
            <p style="font-size: 1.1rem; opacity: 0.9;">Pusat Jual Beli Komponen PC, Laptop, dan PC Rakitan Terlengkap.</p>
        </div>

        <!-- Admin Category Management -->
        <?php if (session()->get('role') === 'admin'): ?>
            <div class="admin-box">
                <div style="width: 100%; margin-bottom: 0.8rem; border-bottom: 1px solid #fecaca; padding-bottom: 0.5rem;">
                    <span style="font-weight: 800; color: #b91c1c; font-size: 0.8rem;"><i class="fas fa-plus-circle"></i> ADMIN: TAMBAH KATEGORI BARU</span>
                </div>
                <form action="/admin/add-category" method="POST" style="display: flex; gap: 1rem; align-items: flex-end; width:100%;">
                    <div style="flex:1;">
                        <label style="font-size: 0.7rem; font-weight: 800; color: #b91c1c; display: block; margin-bottom: 0.2rem;">NAMA KATEGORI</label>
                        <input type="text" name="nama_kategori" class="admin-input" placeholder="Misal: Processor" required style="width:100%;">
                    </div>
                    <div style="flex:1;">
                        <label style="font-size: 0.7rem; font-weight: 800; color: #b91c1c; display: block; margin-bottom: 0.2rem;">ICON (URL/EMOJI)</label>
                        <input type="text" name="icon" class="admin-input" placeholder="URL Flaticon (PNG)" required style="width:100%;">
                    </div>
                    <button type="submit" class="btn-buy primary" style="background: #ef4444; height: 38px;">Simpan Kategori</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Category Section -->
        <section class="section" style="margin-bottom: 3rem;">
            <div class="section-header">
                <h2 class="section-title">Kategori Populer</h2>
            </div>
            <div class="category-wrapper">
                <button class="slider-btn prev" onclick="slideCategories(-1)"><i class="fas fa-chevron-left"></i></button>
                <div class="category-slider" id="categorySlider">
                    <?php foreach ($categories as $cat): ?>
                        <a href="/category/<?= $cat['id'] ?>" class="category-card <?= ($activeCategory == $cat['id']) ? 'active' : '' ?>">
                            <div class="category-icon">
                                <?php if (filter_var($cat['icon'], FILTER_VALIDATE_URL)): ?>
                                    <img src="<?= $cat['icon'] ?>" alt="<?= $cat['nama_kategori'] ?>">
                                <?php else: ?>
                                    <span><?= $cat['icon'] ?: '📦' ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="category-name"><?= $cat['nama_kategori'] ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
                <button class="slider-btn next" onclick="slideCategories(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>

        <!-- Product Listing -->
            <?php if (!empty($groupedProducts)): ?>
                <?php foreach ($groupedProducts as $group): ?>
                    <div style="margin-bottom: 4rem;">
                        <div class="section-header">
                            <h2 class="section-title">
                                <?php if (filter_var($group['category']['icon'], FILTER_VALIDATE_URL)): ?>
                                    <img src="<?= $group['category']['icon'] ?>" style="height: 30px; width: auto; vertical-align: middle; margin-right: 0.5rem;">
                                <?php endif; ?>
                                <?= $group['category']['nama_kategori'] ?>
                            </h2>
                            <a href="/category/<?= $group['category']['id'] ?>" style="font-size: 0.85rem; color: var(--primary); font-weight: 700; text-decoration: none;">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="product-grid">
                            <?php foreach ($group['items'] as $p): 
                                $isInactive = $p['status'] === 'inactive';
                            ?>
                            <div class="product-card" onclick="window.location.href='/product/<?= $p['id'] ?>'" style="<?= $isInactive ? 'opacity: 0.6; filter: grayscale(1);' : '' ?>">
                                <div class="product-img">
                                    <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                                    <?php if ($isInactive): ?>
                                        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); color:white; display:flex; align-items:center; justify-content:center; font-weight:800;">NON-AKTIF</div>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <p class="product-name" title="<?= $p['name'] ?>"><?= $p['name'] ?></p>
                                    <p class="product-price"><?= $p['price'] ?></p>
                                    <div class="product-meta">
                                        <i class="fas fa-map-marker-alt"></i> Indonesia • <?= $p['location'] ?>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                        <div class="product-rating"><i class="fas fa-star" style="color: #fbbf24;"></i> 4.9 (200+)</div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: auto;" onclick="event.stopPropagation()">
                                        <?php if ($isInactive): ?>
                                            <button class="btn-buy" disabled style="grid-column: span 2; background: #e2e8f0; color: #94a3b8;">Tidak Dijual</button>
                                        <?php else: ?>
                                            <button class="btn-buy ghost" onclick="handleBuyAction('cart', <?= $p['id'] ?>)"><i class="fas fa-cart-plus"></i></button>
                                            <button class="btn-buy primary" onclick="handleBuyAction('buy', <?= $p['id'] ?>)">Beli</button>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (session()->get('role') === 'admin'): ?>
                                        <div class="admin-tools" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                                            <p style="font-size: 0.7rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Admin Control</p>
                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                                <button onclick="adminAction('block_shop', <?= $p['shop_id'] ?>)" class="admin-btn" title="Blokir Toko" style="background: #fee2e2; color: #ef4444; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer;"><i class="fas fa-ban"></i> Blokir</button>
                                                <button onclick="adminAction('warn_shop', <?= $p['shop_id'] ?>)" class="admin-btn" title="Beri Teguran" style="background: #fef3c7; color: #d97706; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer;"><i class="fas fa-exclamation-triangle"></i> Tegur</button>
                                                <button onclick="adminAction('delete_product', <?= $p['id'] ?>)" class="admin-btn" title="Hapus Produk" style="grid-column: span 2; background: #f1f5f9; color: #475569; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer; margin-top: 0.3rem;"><i class="fas fa-trash-alt"></i> Hapus Produk</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="section-header">
                    <h2 class="section-title">
                        <?php 
                            if ($activeCategory) {
                                $catName = "Produk";
                                foreach($categories as $c) if($c['id'] == $activeCategory) $catName = $c['nama_kategori'];
                                echo $catName;
                            } elseif ($searchQuery) {
                                echo "Hasil: \"" . esc($searchQuery) . "\"";
                            }
                        ?>
                    </h2>
                    <?php if ($activeCategory || $searchQuery): ?>
                        <a href="/" style="font-size: 0.85rem; color: var(--primary); font-weight: 700; text-decoration: none;">Bersihkan Filter <i class="fas fa-times"></i></a>
                    <?php endif; ?>
                </div>

                <div class="product-grid">
                    <?php if (empty($products)): ?>
                        <div style="grid-column: 1/-1; text-align: center; padding: 5rem 0;">
                            <i class="fas fa-search" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
                            <h3 style="color: #64748b;">Oops! Kami tidak menemukan apa yang kamu cari</h3>
                            <p style="color: #94a3b8; margin-top: 0.5rem;">Coba gunakan kata kunci lain atau browse kategori utama kami.</p>
                            <a href="/" class="btn-buy primary" style="display: inline-block; margin-top: 1.5rem; text-decoration: none;">Lihat Semua Produk</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($products as $p): 
                            $isInactive = $p['status'] === 'inactive';
                        ?>
                        <div class="product-card" onclick="window.location.href='/product/<?= $p['id'] ?>'" style="<?= $isInactive ? 'opacity: 0.6; filter: grayscale(1);' : '' ?>">
                            <div class="product-img">
                                <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                                <?php if ($isInactive): ?>
                                    <div style="position: absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); color:white; display:flex; align-items:center; justify-content:center; font-weight:800;">NON-AKTIF</div>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <p class="product-name" title="<?= $p['name'] ?>"><?= $p['name'] ?></p>
                                <p class="product-price"><?= $p['price'] ?></p>
                                <div class="product-meta">
                                    <i class="fas fa-map-marker-alt"></i> Indonesia • <?= $p['location'] ?>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                    <div class="product-rating"><i class="fas fa-star" style="color: #fbbf24;"></i> 4.9 (200+)</div>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: auto;" onclick="event.stopPropagation()">
                                    <?php if ($isInactive): ?>
                                        <button class="btn-buy" disabled style="grid-column: span 2; background: #e2e8f0; color: #94a3b8;">Tidak Dijual</button>
                                    <?php else: ?>
                                        <button class="btn-buy ghost" onclick="handleBuyAction('cart', <?= $p['id'] ?>)"><i class="fas fa-cart-plus"></i></button>
                                        <button class="btn-buy primary" onclick="handleBuyAction('buy', <?= $p['id'] ?>)">Beli</button>
                                    <?php endif; ?>
                                </div>

                                <?php if (session()->get('role') === 'admin'): ?>
                                    <div class="admin-tools" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                                        <p style="font-size: 0.7rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Admin Control</p>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                            <button onclick="adminAction('block_shop', <?= $p['shop_id'] ?>)" class="admin-btn" title="Blokir Toko" style="background: #fee2e2; color: #ef4444; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer;"><i class="fas fa-ban"></i> Blokir</button>
                                            <button onclick="adminAction('warn_shop', <?= $p['shop_id'] ?>)" class="admin-btn" title="Beri Teguran" style="background: #fef3c7; color: #d97706; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer;"><i class="fas fa-exclamation-triangle"></i> Tegur</button>
                                            <button onclick="adminAction('delete_product', <?= $p['id'] ?>)" class="admin-btn" title="Hapus Produk" style="grid-column: span 2; background: #f1f5f9; color: #475569; border:none; padding: 0.4rem; border-radius: 6px; font-weight: 700; font-size: 0.7rem; cursor: pointer; margin-top: 0.3rem;"><i class="fas fa-trash-alt"></i> Hapus Produk</button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
    </main>

    <script>
        // Dropdown Logic
        const userMenu = document.getElementById('userMenu');
        const profileDropdown = document.getElementById('profileDropdown');

        if (userMenu) {
            userMenu.onclick = (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            };
        }

        document.onclick = () => {
            if (profileDropdown && profileDropdown.classList.contains('show')) profileDropdown.classList.remove('show');
        };

        // Slider Logic
        const slider = document.getElementById('categorySlider');
        function slideCategories(dir) {
            const amount = 300;
            slider.scrollLeft += (dir * amount);
        }

        // Buy Action
        function handleBuyAction(type, id) {
            <?php if (!session()->get('logged_in')): ?>
                alert("Silakan login terlebih dahulu.");
                window.location.href = "/login";
                return;
            <?php endif; ?>

            if (type === 'cart') {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/cart/add';
                const pInput = document.createElement('input'); pInput.type = 'hidden'; pInput.name = 'product_id'; pInput.value = id;
                const qInput = document.createElement('input'); qInput.type = 'hidden'; qInput.name = 'qty'; qInput.value = 1;
                form.appendChild(pInput);
                form.appendChild(qInput);
                document.body.appendChild(form);
                form.submit();
            } else {
                window.location.href = "/checkout?id=" + id + "&qty=1";
            }
        }

        function adminAction(type, id) {
            let url = "";
            let method = "POST";

            if (type === 'block_shop') {
                if (confirm("Apakah Anda yakin ingin MEMBLOCKIR toko ini? Semua produknya akan disembunyikan.")) {
                    url = "/admin/block-shop/" + id;
                }
            } else if (type === 'warn_shop') {
                let note = prompt("Berikan alasan teguran untuk pemilik toko:");
                if (note) {
                    url = "/admin/warn-shop/" + id + "?note=" + encodeURIComponent(note);
                }
            } else if (type === 'delete_product') {
                if (confirm("Hapus produk ini secara permanen dari marketplace?")) {
                    url = "/admin/delete-product/" + id;
                }
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
