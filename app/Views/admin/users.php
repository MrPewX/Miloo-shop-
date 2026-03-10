<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="header-section" style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">Manajemen Pengguna</h1>
    <p style="color: var(--secondary);">Database seluruh admin, penjual, dan pelanggan.</p>
</div>

<div class="card">
    <div style="padding: 1rem; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: #f8fafc; border-bottom: 1px solid #f1f5f9; color: var(--secondary); font-size: 0.85rem; text-transform: uppercase;">
                    <th style="padding: 1rem 1.5rem;">ID</th>
                    <th>User Info</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="text-align: right; padding-right: 1.5rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 1.2rem 1.5rem; color: var(--secondary); font-weight: 700;">#<?= $user['id'] ?></td>
                    <td>
                        <div style="font-weight: 800; color: #1e293b;"><?= $user['username'] ?></div>
                        <div style="font-size: 0.7rem; color: var(--secondary);">Terdaftar: <?= date('d M Y', strtotime($user['created_at'] ?? 'now')) ?></div>
                    </td>
                    <td style="font-weight: 500; font-size: 0.9rem;"><?= $user['email'] ?></td>
                    <td>
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;
                            <?php if($user['role'] == 'admin'): ?> background: #fee2e2; color: #b91c1c; 
                            <?php elseif($user['role'] == 'penjual'): ?> background: #dcfce7; color: #15803d;
                            <?php else: ?> background: #f1f5f9; color: #475569; <?php endif; ?>
                        ">
                            <?= $user['role'] ?>
                        </span>
                    </td>
                    <td style="text-align: right; padding-right: 1.5rem;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                            <button onclick='editUser(<?= json_encode($user) ?>)' class="btn" style="background: #f1f5f9; color: #475569; padding: 0.5rem;"><i class="fas fa-edit"></i></button>
                            <button onclick="deleteUser(<?= $user['id'] ?>)" class="btn" style="background: #fee2e2; color: #ef4444; padding: 0.5rem;"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editModal" style="display:none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
    <div style="background: white; width: 450px; border-radius: 20px; padding: 2rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2);">
        <h2 style="font-weight: 800; margin-bottom: 1.5rem; color: #1e293b;">Edit Data Pengguna</h2>
        <form id="editForm" method="POST">
            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.75rem; font-weight: 800; color: var(--secondary); display: block; margin-bottom: 0.4rem;">USERNAME</label>
                <input type="text" name="username" id="editUsername" style="width: 100%; padding: 0.7rem; border: 1px solid #e2e8f0; border-radius: 10px;" required>
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.75rem; font-weight: 800; color: var(--secondary); display: block; margin-bottom: 0.4rem;">EMAIL</label>
                <input type="email" name="email" id="editEmail" style="width: 100%; padding: 0.7rem; border: 1px solid #e2e8f0; border-radius: 10px;" required>
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.75rem; font-weight: 800; color: var(--secondary); display: block; margin-bottom: 0.4rem;">ROLE</label>
                <select name="role" id="editRole" style="width: 100%; padding: 0.7rem; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <option value="admin">Admin</option>
                    <option value="penjual">Penjual</option>
                    <option value="pelanggan">Pelanggan</option>
                </select>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.75rem; font-weight: 800; color: var(--secondary); display: block; margin-bottom: 0.4rem;">GANTI PASSWORD (Kosongkan jika tidak ingin ganti)</label>
                <input type="password" name="password" style="width: 100%; padding: 0.7rem; border: 1px solid #e2e8f0; border-radius: 10px;">
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <button type="button" onclick="closeModal()" style="padding: 0.8rem; border-radius: 12px; border: 1px solid #e2e8f0; background: white; font-weight: 700; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 0.8rem; border-radius: 12px; border: none; background: var(--primary); color: white; font-weight: 700; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteUser(id) {
        if (confirm("Apakah Anda yakin ingin menghapus pengguna ini? Semua data terkait (toko, produk) mungkin akan terpengaruh.")) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/delete-user/' + id;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function editUser(user) {
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editRole').value = user.role;
        document.getElementById('editForm').action = '/admin/update-user/' + user.id;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('editModal')) closeModal();
    }
</script>
<?= $this->endSection() ?>
