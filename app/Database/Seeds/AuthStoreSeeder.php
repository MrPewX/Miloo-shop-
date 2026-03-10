<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthStoreSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Create Sellers
        $sellers = [
            ['username' => 'pcmaster', 'email' => 'pcmaster@miloo.com', 'role' => 'penjual'],
            ['username' => 'laptop_haven', 'email' => 'laptop@miloo.com', 'role' => 'penjual'],
            ['username' => 'icorner', 'email' => 'apple@miloo.com', 'role' => 'penjual'],
            ['username' => 'gpu_depot', 'email' => 'gpu@miloo.com', 'role' => 'penjual'],
            ['username' => 'indo_hardware', 'email' => 'hardware@miloo.com', 'role' => 'penjual'],
            ['username' => 'tech_store', 'email' => 'tech@miloo.com', 'role' => 'penjual'],
            ['username' => 'gamer_zone', 'email' => 'gamer@miloo.com', 'role' => 'penjual'],
            ['username' => 'creative_station', 'email' => 'creative@miloo.com', 'role' => 'penjual'],
            ['username' => 'digital_uni', 'email' => 'digital@miloo.com', 'role' => 'penjual'],
            ['username' => 'pro_part', 'email' => 'propart@miloo.com', 'role' => 'penjual'],
        ];

        foreach ($sellers as $s) {
            $check = $db->table('users')->where('email', $s['email'])->get()->getRow();
            if (!$check) {
                $db->table('users')->insert([
                    'username' => $s['username'],
                    'email'    => $s['email'],
                    'password' => password_hash('seller123', PASSWORD_DEFAULT),
                    'role'     => 'penjual',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // 2. Clear then re-link shops to these specific users
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('shops')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        $allSellers = $db->table('users')->where('role', 'penjual')->get()->getResultArray();
        
        $shopsData = [
            ['name' => 'PC Master Builder', 'desc' => 'Spesialis PC Rakitan Gaming & Kerja.'],
            ['name' => 'Laptop Haven', 'desc' => 'Pusat Laptop Office & Multimedia.'],
            ['name' => 'iCorner Apple Specialist', 'desc' => 'MacBook dan iMac Original Terlengkap.'],
            ['name' => 'GPU & CPU Depot', 'desc' => 'Komponen inti PC dengan harga terbaik.'],
            ['name' => 'Indo Hardware Center', 'desc' => 'Memory, Storage, dan Motherboard.'],
            ['name' => 'Tech Synergy', 'desc' => 'Laptop, PC, dan Part dalam satu toko.'],
            ['name' => 'Gamer Zone', 'desc' => 'Semua kebutuhan Gaming PC dan Aksesoris.'],
            ['name' => 'Creative Station', 'desc' => 'PC Rakitan Desain dan MacBook Pro.'],
            ['name' => 'Digital Universe', 'desc' => 'Toko serba ada untuk kebutuhan IT.'],
            ['name' => 'Pro Part Indonesia', 'desc' => 'Grosir sparepart laptop dan part PC.'],
        ];

        foreach ($shopsData as $index => $s) {
            if (isset($allSellers[$index])) {
                $db->table('shops')->insert([
                    'user_id' => $allSellers[$index]['id'],
                    'nama_toko' => $s['name'],
                    'deskripsi_toko' => $s['desc'],
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
