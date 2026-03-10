<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Miloo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #00AA5B; --primary-hover: #008f4c; --primary-light: #EBFFEE; --dark: #1e293b; --secondary: #64748b; --danger: #ef4444; }
        * { margin:0; padding:0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; color: var(--dark); padding: 1rem; }
        
        .success-card { background: white; padding: 4rem 2rem; border-radius: 32px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); max-width: 550px; text-align: center; border: 1px solid #eef2f6; position: relative; overflow: hidden; }
        .success-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: linear-gradient(90deg, #00aa5b, #10b981); }
        
        .icon-circle { width: 100px; height: 100px; background: var(--primary-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; margin: 0 auto 2.5rem; animation: iconBounce 1s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        
        @keyframes iconBounce { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        
        h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem; color: #1e293b; }
        p { color: #64748b; margin-bottom: 2.5rem; line-height: 1.6; font-size: 1.1rem; }
        
        .btn-group { display: flex; flex-direction: column; gap: 1rem; }
        .btn { padding: 1.2rem; border-radius: 16px; font-weight: 800; font-size: 1rem; text-decoration: none; cursor: pointer; transition: 0.3s; width: 100%; display: block; border: none; }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 10px 25px rgba(0, 170, 91, 0.2); }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-3px); }
        .btn-ghost { background: white; color: var(--secondary); border: 2px solid #e2e8f0; }
        .btn-ghost:hover { background: #f8fafc; color: var(--dark); }
        
        .order-id { font-family: monospace; font-size: 0.9rem; color: #94a3b8; margin-bottom: 1rem; background: #f1f5f9; padding: 4px 12px; border-radius: 6px; display: inline-block; }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="icon-circle">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="order-id">TRANSACTION ID: #MILOO-<?= strtoupper(substr(md5(time()), 0, 8)) ?></div>
        <h1>Pembayaran Sukses!</h1>
        <p>Terima kasih telah berbelanja di Miloo Tech Hub. Komponen pesanan Anda sedang kami siapkan untuk proses pengiriman kilat.</p>
        
        <div class="btn-group">
            <a href="/" class="btn btn-primary">Lanjut Belanja</a>
            <a href="/dashboard" class="btn btn-ghost">Cek Status Pesanan</a>
        </div>
        
        <div style="margin-top: 3rem; font-size: 0.8rem; color: #94a3b8; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
            <i class="fas fa-shield-alt"></i> Keamanan Transaksi Terjamin oleh Miloo-Sec
        </div>
    </div>
</body>
</html>
