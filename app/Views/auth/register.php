<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Miloo Shop</title>
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

        .register-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            padding: 3rem;
            border-radius: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .header { text-align: center; margin-bottom: 2rem; }
        .logo {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, var(--primary), #a855f7);
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem; color: white; font-size: 1.5rem; font-weight: 700;
        }
        .header h1 { font-size: 1.6rem; font-weight: 700; color: var(--dark); }
        .header p { color: #64748b; font-size: 0.9rem; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1.2rem; }
        .full-width { grid-column: span 2; }
        
        .form-group label { display: block; margin-bottom: 0.4rem; font-size: 0.85rem; font-weight: 500; color: #475569; }
        .form-group input {
            width: 100%; padding: 0.7rem 1rem; border-radius: 10px;
            border: 1px solid #e2e8f0; background: white; transition: all 0.2s;
            font-size: 0.95rem;
        }
        .form-group input:focus { outline: none; border-color: var(--primary); }

        .btn {
            width: 100%; padding: 0.9rem; border-radius: 10px; border: none;
            background: var(--primary); color: white; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s; margin-top: 0.5rem;
        }
        .btn:hover { background: var(--primary-dark); transform: translateY(-2px); }

        .footer { text-align: center; margin-top: 1.5rem; color: #64748b; font-size: 0.85rem; }
        .footer a { color: var(--primary); text-decoration: none; font-weight: 600; }

        .errors { background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.8rem; }
        .errors ul { margin-left: 1.2rem; }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="header">
            <div class="logo">M</div>
            <h1>Buat Akun Baru</h1>
            <p>Bergabung dengan komunitas Miloo Shop</p>
        </div>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="errors">
                <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= old('username') ?>" placeholder="joedoe" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= old('email') ?>" placeholder="joe@example.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min. 6 karakter" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm_password" placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn">Daftar Akun</button>
        </form>

        <div class="footer">
            Sudah punya akun? <a href="/login">Login di sini</a>
        </div>
    </div>
</body>
</html>
