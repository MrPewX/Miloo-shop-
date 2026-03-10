<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReviewStoreSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $productIds = array_column($db->table('products')->get()->getResultArray(), 'id');
        $userIds = array_column($db->table('users')->get()->getResultArray(), 'id'); // and pelanggan/admin etc.

        $comments = [
            "Barang original, packing aman banget!",
            "Performa gila, cocok buat gaming 4K.",
            "Seller ramah, respon cepat. Recomended!",
            "Pengiriman agak lambat tapi barang sampai dengan selamat.",
            "Kualitas oke, sesuai deskripsi.",
            "Macbooknya mulus, garansi resmi aktif. Puas!",
            "GPU gahar, suhu adem pas running game berat.",
            "SSD kenceng bgt, booting cuma 5 detik.",
            "Monitor jernih, no dead pixel.",
            "Mantap djiwa, build pc disini gak nyesel."
        ];

        foreach ($productIds as $pid) {
            // Add 2-3 reviews per product
            $count = rand(2, 4);
            for ($i = 0; $i < $count; $i++) {
                $db->table('reviews')->insert([
                    'product_id' => $pid,
                    'user_id'    => $userIds[array_rand($userIds)],
                    'rating'     => rand(4, 5),
                    'comment'    => $comments[array_rand($comments)],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
