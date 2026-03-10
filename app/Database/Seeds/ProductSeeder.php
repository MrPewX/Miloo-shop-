<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categoryModel = new \App\Models\CategoryModel();
        $shopModel = new \App\Models\ShopModel();
        $productModel = new \App\Models\ProductModel();

        // Ensure we have categories
        $categoryModel->ignore(true)->insert(['nama_kategori' => 'Gadget']);
        $gadgetId = $categoryModel->getInsertID();
        
        $categoryModel->ignore(true)->insert(['nama_kategori' => 'Fashion']);
        $fashionId = $categoryModel->getInsertID();

        // Get first shop
        $shop = $shopModel->first();
        if (!$shop) {
             // Fallback if UserSeeder wasn't run or failed
             return;
        }
        $shopId = $shop['id'];

        $data = [
            [
                'shop_id'     => $shopId,
                'category_id' => $gadgetId,
                'nama_produk' => 'Jam Tangan Minimalis White Premium',
                'deskripsi'   => 'Lengkapi gaya keseharianmu dengan jam tangan minimalis berbalut kulit sintetis premium.',
                'harga'       => 250000,
                'stok'        => 50,
                'foto_url'    => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800',
                'status'      => 'active'
            ],
            [
                'shop_id'     => $shopId,
                'category_id' => $gadgetId,
                'nama_produk' => 'Headphone Wireless Noise Cancelling',
                'deskripsi'   => 'Nikmati audio berkualitas tinggi tanpa gangguan suara dari luar. Baterai tahan 24 jam.',
                'harga'       => 890000,
                'stok'        => 25,
                'foto_url'    => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
                'status'      => 'active'
            ],
            [
                'shop_id'     => $shopId,
                'category_id' => $fashionId,
                'nama_produk' => 'Sepatu Lari Sporty Merah',
                'deskripsi'   => 'Ringan dan empuk untuk performa lari harian terbaikmu.',
                'harga'       => 450000,
                'stok'        => 30,
                'foto_url'    => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800',
                'status'      => 'active'
            ],
            [
                'shop_id'     => $shopId,
                'category_id' => $gadgetId,
                'nama_produk' => 'Kamera Instax Mini 11 Charcoal Grey',
                'deskripsi'   => 'Ambil momen manismu secara instan dengan kamera instax yang trendy ini.',
                'harga'       => 1100000,
                'stok'        => 15,
                'foto_url'    => 'https://images.unsplash.com/photo-1526170315870-ef6872f8971f?w=800',
                'status'      => 'active'
            ]
        ];

        foreach ($data as $item) {
            $productModel->insert($item);
        }
    }
}
