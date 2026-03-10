<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('users')->truncate();
        $db->table('shops')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        $userModel = new \App\Models\UserModel();

        // 1. Admin
        $userModel->insert([
            'username' => 'admin',
            'email'    => 'admin@miloo.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin'
        ]);

        // 2. 10 Seller Accounts
        for ($i = 1; $i <= 10; $i++) {
            $userModel->insert([
                'username' => 'seller' . $i,
                'email'    => "seller$i@miloo.com",
                'password' => password_hash('seller123', PASSWORD_DEFAULT),
                'role'     => 'penjual'
            ]);
        }

        // 3. 5 Normal Customers
        for ($i = 1; $i <= 5; $i++) {
            $userModel->insert([
                'username' => 'buyer' . $i,
                'email'    => "buyer$i@miloo.com",
                'password' => password_hash('buyer123', PASSWORD_DEFAULT),
                'role'     => 'pelanggan'
            ]);
        }
    }
}
