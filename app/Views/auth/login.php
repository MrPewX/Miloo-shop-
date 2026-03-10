<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Miloo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --dark: #0f172a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            padding: 3rem;
            border-radius: 30px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .header { text-align: center; margin-bottom: 2.5rem; }
        .logo {
            width: 60px; height: 60px;
            background: linear-gradient(135deg, var(--primary), #a855f7);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem; color: white; font-size: 1.8rem; font-weight: 700;
        }
        .header h1 { font-size: 1.8rem; font-weight: 700; color: var(--dark); margin-bottom: 0.5rem; }
        .header p { color: #64748b; font-size: 0.95rem; }

        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500; color: #475569; }
        .form-group input {
            width: 100%; padding: 0.8rem 1.2rem; border-radius: 12px;
            border: 1px solid #e2e8f0; background: white; transition: all 0.2s;
            font-size: 1rem;
        }
        .form-group input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }

        .btn {
            width: 100%; padding: 1rem; border-radius: 12px; border: none;
            background: var(--primary); color: white; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s; margin-top: 1rem;
        }
        .btn:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); }

        .footer { text-align: center; margin-top: 2rem; color: #64748b; font-size: 0.9rem; }
        .footer a { color: var(--primary); text-decoration: none; font-weight: 600; }

        .alert { padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 0.9rem; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="header">
            <div class="logo">M</div>
            <h1>Selamat Datang</h1>
            <p>Login ke akun Miloo Shop Anda</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="/login" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="nama@email.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Masuk ke Dashboard</button>
        </form>

        <div class="footer">
            Belum punya akun? <a href="/register">Daftar Sekarang</a>
        </div>
    </div>
</body>
</html>
