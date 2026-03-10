<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['nama_produk'] ?> - Miloo Tech Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --light: #f8fafc; --secondary: #64748b; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: #f1f5f9; color: var(--dark); padding-bottom: 50px; }
        
        .navbar { background: white; padding: 1rem 5%; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { font-weight: 800; font-size: 1.5rem; text-decoration: none; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .logo-box { width: 32px; height: 32px; background: var(--primary); border-radius: 6px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }
        .cart-btn { position: relative; color: var(--secondary); font-size: 1.3rem; text-decoration: none; transition: 0.2s; }
        .cart-btn:hover { color: var(--primary); }
        .cart-badge { position: absolute; top: -8px; right: -10px; background: #ef4444; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 10px; font-weight: 700; border: 2px solid white; }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; display: grid; grid-template-columns: 1fr 1.2fr 1fr; gap: 2rem; }
        
        .image-card { background: white; border-radius: 20px; overflow: hidden; position: sticky; top: 100px; height: fit-content; border: 1px solid #e2e8f0; }
        .product-main-img { width: 100%; aspect-ratio: 1; object-fit: cover; }
        
        .price { font-size: 1.8rem; font-weight: 800; color: var(--primary); margin: 0.5rem 0; }
        .product-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; }
        
        .section-box { background: white; padding: 1.5rem; border-radius: 16px; margin-bottom: 1.5rem; border: 1px solid #e2e8f0; }
        .tabs { display: flex; gap: 1.5rem; border-bottom: 1px solid #e2e8f0; margin-bottom: 1rem; }
        .tab { padding: 0.8rem 0; font-weight: 600; cursor: pointer; color: var(--secondary); position: relative; }
        .tab.active { color: var(--primary); }
        .tab.active::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px; background: var(--primary); }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .shop-info { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; margin: 1rem 0; }
        .shop-logo { width: 50px; height: 50px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary); }

        .sticky-action { background: white; padding: 1.5rem; border-radius: 16px; position: sticky; top: 100px; height: fit-content; border: 1px solid #e2e8f0; }
        .btn-buy { width: 100%; padding: 0.8rem; background: var(--primary); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; margin-bottom: 0.8rem; transition: 0.2s; }
        .btn-buy:hover { background: var(--primary-hover); }
        .btn-cart { width: 100%; padding: 0.8rem; background: white; color: var(--primary); border: 2px solid var(--primary); border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.2s; }
        .btn-cart:hover { background: var(--primary-light); }

        .admin-action-box { margin-top: 1.5rem; padding: 1rem; background: #fff1f2; border: 1px solid #fecaca; border-radius: 12px; }
        .admin-label { font-size: 0.75rem; font-weight: 800; color: var(--secondary); display: block; margin-bottom: 0.3rem; }
        .admin-input { width: 100%; padding: 0.5rem; border-radius: 8px; border: 1px solid #fca5a5; margin-bottom: 1rem; font-size: 0.9rem; }

        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
            .image-card, .sticky-action { position: static; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 2rem;">
            <a href="javascript:history.back()" style="text-decoration: none; color: var(--secondary); font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="/" class="logo">
                <div class="logo-box">M</div> Miloo Tech Hub
            </a>
        </div>
        
        <div class="nav-actions">
            <?php $cartCount = session()->get('cart') ? count(session()->get('cart')) : 0; ?>
            <a href="/cart" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge"><?= $cartCount ?></span>
            </a>
            <div style="width: 1px; height: 25px; background: #e2e8f0;"></div>
            <?php if (session()->get('logged_in')): ?>
                <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                    <div style="width: 32px; height: 32px; background: var(--primary-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <?= substr(session()->get('username'), 0, 1) ?>
                    </div>
                </div>
            <?php else: ?>
                <a href="/login" style="text-decoration: none; color: var(--primary); font-weight: 700;">Masuk</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <?php $isInactive = $product['status'] === 'inactive'; ?>
        
        <!-- Part 1: Images -->
        <div class="image-card" style="<?= $isInactive ? 'opacity: 0.7; filter: grayscale(0.2);' : '' ?>">
            <div id="main-display" style="position: relative;">
                <img src="<?= $product['foto_url'] ?: 'https://via.placeholder.com/600x600?text=No+Image' ?>" id="current-img" class="product-main-img" alt="">
                <?php if ($isInactive): ?>
                    <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.2); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">NON-AKTIF</div>
                <?php endif; ?>
            </div>
            <div style="display: flex; gap: 0.5rem; padding: 1rem; overflow-x: auto; background: white;">
                <?php if(!empty($product['foto_url'])): ?>
                    <img src="<?= $product['foto_url'] ?>" onclick="changeImg(this.src)" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid var(--primary);">
                <?php endif; ?>
                <?php foreach ($images as $img): ?>
                    <img src="<?= $img['foto_url'] ?>" onclick="changeImg(this.src)" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent;">
                <?php endforeach; ?>
            </div>

            <?php if (session()->get('role') === 'admin' || (session()->get('role') === 'penjual' && session()->get('id') == $product['user_id'])): ?>
                <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; background: #fff1f2;">
                    <p style="font-size: 0.8rem; font-weight: 800; color: #b91c1c; margin-bottom: 1rem;"><i class="fas fa-camera"></i> KELOLA GAMBAR (OWNER/ADMIN)</p>
                    
                    <form action="/admin/add-product-image/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
                        <div style="display: flex; flex-direction: column; gap: 0.8rem; margin-bottom: 1.5rem;">
                            <div>
                                <label class="admin-label">Upload File Gambar</label>
                                <input type="file" name="file_image" class="admin-input" style="margin-bottom: 0.5rem;">
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="flex:1; height: 1px; background: #fecaca;"></div>
                                <span style="font-size: 0.7rem; color: #f87171; font-weight: 700;">ATAU</span>
                                <div style="flex:1; height: 1px; background: #fecaca;"></div>
                            </div>
                            <div>
                                <label class="admin-label">Gunakan URL Gambar</label>
                                <div style="display: flex; gap: 0.5rem;">
                                    <input type="text" name="url" placeholder="https://..." class="admin-input" style="margin-bottom: 0;">
                                    <button type="submit" style="padding: 0 1rem; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 700;">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(60px, 1fr)); gap: 0.8rem;">
                        <?php if(!empty($product['foto_url'])): ?>
                            <div style="position: relative;">
                                <img src="<?= $product['foto_url'] ?>" style="width: 100%; aspect-ratio:1; object-fit: cover; border-radius: 8px; border: 2px solid #ef4444;">
                                <form action="/admin/delete-main-image/<?= $product['id'] ?>" method="POST">
                                    <button type="submit" onclick="return confirm('Hapus gambar utama?')" style="position: absolute; top:-8px; right:-8px; width: 22px; height: 22px; background: #ef4444; color: white; border: none; border-radius: 50%; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($images as $img): ?>
                            <div style="position: relative;">
                                <img src="<?= $img['foto_url'] ?>" style="width: 100%; aspect-ratio:1; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <a href="/admin/delete-product-image/<?= $img['id'] ?>" onclick="return confirm('Hapus gambar ini?')" style="position: absolute; top:-8px; right:-8px; width: 22px; height: 22px; background: #64748b; color: white; border: none; border-radius: 50%; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"><i class="fas fa-times"></i></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Part 2: Product Info -->
        <div class="detail-card">
            <h1 class="product-title"><?= $product['nama_produk'] ?></h1>
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <span style="font-weight: 700; color: #fbbf24;"><i class="fas fa-star"></i> 4.9</span>
                <span style="color: var(--secondary); font-size: 0.9rem;">(128 Ulasan)</span>
                <span style="width: 4px; height: 4px; border-radius: 50%; background: #cbd5e1;"></span>
                <span style="color: var(--secondary); font-size: 0.9rem;">Terjual 100+</span>
            </div>
            <p class="price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
            
            <div class="shop-info">
                <div class="shop-logo" onclick="window.location.href='/shop/<?= $product['shop_id'] ?>'" style="cursor: pointer;"><i class="fas fa-store"></i></div>
                <div style="flex:1;">
                    <p style="font-weight: 700; cursor: pointer; font-size: 1.1rem;" onclick="window.location.href='/shop/<?= $product['shop_id'] ?>'"><?= $product['nama_toko'] ?></p>
                    <p style="font-size: 0.85rem; color: #10b981;"><i class="fas fa-check-circle"></i> Berhasil Terverifikasi</p>
                </div>
                
                <?php if (session()->get('role') === 'admin'): ?>
                    <div style="display: flex; gap: 0.5rem;">
                        <button onclick="adminAction('warn_shop', <?= $product['shop_id'] ?>)" style="padding: 0.5rem; background: #fef3c7; color: #d97706; border: none; border-radius: 8px; cursor: pointer;" title="Tegur Toko"><i class="fas fa-exclamation-triangle"></i></button>
                        <button onclick="adminAction('block_shop', <?= $product['shop_id'] ?>)" style="padding: 0.5rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; cursor: pointer;" title="Blokir Toko"><i class="fas fa-ban"></i></button>
                    </div>
                <?php endif; ?>
                
                <button onclick="toggleFollow(this)" style="padding: 0.5rem 1.2rem; border: 1px solid var(--primary); border-radius: 10px; background: white; font-weight: 700; color: var(--primary); cursor: pointer; transition: 0.2s;">Follow</button>
            </div>

            <div class="section-box">
                <div class="tabs">
                    <div class="tab active" data-tab="desc">Detail Produk</div>
                    <div class="tab" data-tab="specs">Spesifikasi</div>
                </div>
                <div id="tab-desc" class="tab-content active" style="line-height: 1.7; color: #334155; font-size: 0.95rem;">
                    <?= nl2br($product['deskripsi'] ?: 'Tidak ada deskripsi produk.') ?>
                </div>
                <div id="tab-specs" class="tab-content" style="line-height: 1.7; color: #334155;">
                    <?php if (empty(trim($product['spesifikasi']))): ?>
                        <div style="text-align: center; padding: 2rem; color: var(--secondary);">
                            <i class="fas fa-info-circle" style="font-size: 2rem; display: block; margin-bottom: 0.5rem; opacity: 0.3;"></i>
                            <p>Spesifikasi belum tersedia.</p>
                        </div>
                    <?php else: ?>
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                            <?php 
                            $specs = explode("\n", $product['spesifikasi']);
                            foreach($specs as $s): 
                                if(trim($s) == "") continue;
                                $parts = explode(":", $s, 2);
                            ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 1rem 0; font-weight: 600; width: 35%; color: var(--secondary); background: #fbfcfd; padding-left: 0.5rem;"><?= trim($parts[0] ?? '-') ?></td>
                                <td style="padding: 1rem 0; padding-left: 1rem;"><?= trim($parts[1] ?? '-') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>

                <?php if (session()->get('role') === 'admin' || (session()->get('role') === 'penjual' && session()->get('id') == $product['user_id'])): ?>
                    <div class="admin-action-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                            <p style="font-weight: 800; color: #b91c1c; font-size: 0.8rem;"><i class="fas fa-edit"></i> OWNER/ADMIN EDITOR</p>
                            <?php if (session()->get('role') === 'admin'): ?>
                                <button onclick="adminAction('delete_product', <?= $product['id'] ?>)" style="background: #ef4444; color: white; border: none; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 0.7rem; cursor: pointer;"><i class="fas fa-trash"></i> HAPUS PRODUK</button>
                            <?php endif; ?>
                        </div>
                        
                        <form action="/admin/update-product-data/<?= $product['id'] ?>" method="POST">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label class="admin-label">KATEGORI</label>
                                    <select name="category_id" class="admin-input">
                                        <?php foreach($allCategories as $c): ?>
                                            <option value="<?= $c['id'] ?>" <?= $c['id'] == $product['category_id'] ? 'selected' : '' ?>><?= $c['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="admin-label">STATUS PRODUK</label>
                                    <select name="status" class="admin-input">
                                        <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>Aktif (Dijual)</option>
                                        <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>Non-Aktif (Sembunyikan)</option>
                                    </select>
                                </div>
                            </div>

                            <label class="admin-label">DESKRIPSI PRODUK</label>
                            <textarea name="deskripsi" class="admin-input" style="height: 120px; line-height: 1.5;"><?= $product['deskripsi'] ?></textarea>
                            
                            <label class="admin-label">SPESIFIKASI (Label: Nilai per baris)</label>
                            <textarea name="spesifikasi" class="admin-input" style="height: 120px; line-height: 1.5;" placeholder="Contoh:&#10;OS: Windows 11&#10;RAM: 16GB DDR4"><?= $product['spesifikasi'] ?></textarea>
                            
                            <button type="submit" class="btn-buy" style="background: #ef4444; border-radius: 10px; padding: 0.7rem;">Simpan Semua Perubahan</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="section-box">
                <h3 style="margin-bottom: 1.5rem;">Ulasan Pembeli</h3>
                <?php if (empty($reviews)): ?>
                    <div style="text-align: center; padding: 3rem 1rem; color: var(--secondary);">
                        <i class="fas fa-comment-slash" style="font-size: 2.5rem; opacity: 0.2; display: block; margin-bottom: 1rem;"></i>
                        <p>Produk ini belum memiliki ulasan.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($reviews as $rev): ?>
                        <div class="review-card">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <p style="font-weight: 700; font-size: 0.95rem; color: var(--dark);"><?= $rev['username'] ?></p>
                                <span style="font-size: 0.8rem; color: var(--secondary); background: #f1f5f9; padding: 2px 8px; border-radius: 20px;"><?= date('d M Y', strtotime($rev['created_at'])) ?></span>
                            </div>
                            <div class="rating-stars" style="margin: 0.3rem 0;">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <i class="fas fa-star" style="color: <?= $i <= $rev['rating'] ? '#fbbf24' : '#e2e8f0' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p style="margin-top: 0.5rem; font-size: 0.95rem; line-height: 1.5;"><?= $rev['comment'] ?></p>
                            
                            <?php if (session()->get('role') === 'admin'): ?>
                                <a href="/admin/delete-review/<?= $rev['id'] ?>" onclick="return confirm('Hapus ulasan ini?')" style="margin-top: 0.8rem; color: #ef4444; text-decoration: none; display: inline-block; font-size: 0.8rem; font-weight: 700;"><i class="fas fa-trash"></i> HAPUS ULASAN</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Part 3: Action Box -->
        <div class="sticky-action">
            <h3 style="margin-bottom: 1.2rem; font-size: 1.1rem; font-weight: 800;">Atur Jumlah</h3>
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; border: 2px solid #e2e8f0; border-radius: 12px; padding: 0.3rem;">
                    <button id="minus-btn" style="width: 32px; height: 32px; border:none; background:none; cursor:pointer; font-size: 1.2rem; color: var(--primary); font-weight: 700;">-</button>
                    <input type="text" id="qty-input" value="1" readonly style="width: 45px; text-align: center; border: none; outline: none; font-weight: 800; font-size: 1.1rem; color: var(--dark);">
                    <button id="plus-btn" style="width: 32px; height: 32px; border:none; background:none; cursor:pointer; font-size: 1.2rem; color: var(--primary); font-weight: 700;">+</button>
                </div>
                <div style="font-size: 0.9rem;">
                    <p style="color: var(--secondary);">Stok: <b><?= $product['stok'] ?></b></p>
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                <p style="color: var(--secondary); font-weight: 600;">Subtotal</p>
                <p id="subtotal-display" style="font-weight: 800; font-size: 1.4rem; color: var(--primary);">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
            </div>

            <?php if ($isInactive): ?>
                <button class="btn-buy" style="background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; cursor: not-allowed;" disabled>Produk Tidak Tersedia</button>
            <?php else: ?>
                <button class="btn-buy" onclick="handleBuyNow()">Beli Langsung</button>
                <button class="btn-cart" onclick="handleAddToCart()"><i class="fas fa-cart-plus"></i> + Keranjang</button>
            <?php endif; ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; margin-top: 1.2rem; font-size: 0.85rem; font-weight: 600;">
                <button style="background: none; border: 1px solid #e2e8f0; padding: 0.5rem; border-radius: 8px; cursor: pointer; color: var(--secondary);"><i class="fas fa-comment-dots"></i> Chat Toko</button>
                <button style="background: none; border: 1px solid #e2e8f0; padding: 0.5rem; border-radius: 8px; cursor: pointer; color: var(--secondary);"><i class="fas fa-share-alt"></i> Bagikan</button>
            </div>
        </div>
    </div>

    <script>
        const pricePerItem = <?= $product['harga'] ?>;
        const qtyInput = document.getElementById('qty-input');
        const subtotalDisplay = document.getElementById('subtotal-display');
        const maxStok = <?= $product['stok'] ?>;

        document.getElementById('plus-btn').addEventListener('click', () => {
            if (parseInt(qtyInput.value) < maxStok) {
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateSubtotal();
            }
        });

        document.getElementById('minus-btn').addEventListener('click', () => {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
                updateSubtotal();
            }
        });

        function updateSubtotal() {
            const subtotal = pricePerItem * parseInt(qtyInput.value);
            subtotalDisplay.innerText = "Rp " + subtotal.toLocaleString('id-ID');
        }

        function changeImg(src) {
            document.getElementById('current-img').src = src;
            const thumbs = document.querySelectorAll('.image-card img');
            thumbs.forEach(t => t.style.borderColor = (t.src === src) ? 'var(--primary)' : 'transparent');
        }

        // Tab Switching
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-tab');
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                this.classList.add('active');
                document.getElementById('tab-' + target).classList.add('active');
            });
        });

        function handleAddToCart() {
            submitCartForm();
        }

        function handleBuyNow() {
            window.location.href = "/checkout?id=<?= $product['id'] ?>&qty=" + qtyInput.value;
        }

        function submitCartForm() {
            <?php if (!session()->get('logged_in')): ?>
                alert("Silakan login terlebih dahulu.");
                window.location.href = "/login";
                return;
            <?php endif; ?>
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/cart/add';
            
            const pInput = document.createElement('input');
            pInput.type = 'hidden'; pInput.name = 'product_id'; pInput.value = '<?= $product['id'] ?>';
            
            const qInput = document.createElement('input');
            qInput.type = 'hidden'; qInput.name = 'qty'; qInput.value = qtyInput.value;
            
            form.appendChild(pInput);
            form.appendChild(qInput);
            document.body.appendChild(form);
            form.submit();
        }

        function toggleFollow(btn) {
            if (btn.innerText === "Follow") {
                btn.innerText = "Following";
                btn.style.background = "#eff6ff";
                btn.style.color = "#2563eb";
                btn.style.borderColor = "#2563eb";
            } else {
                btn.innerText = "Follow";
                btn.style.background = "white";
                btn.style.color = "var(--primary)";
                btn.style.borderColor = "var(--primary)";
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
