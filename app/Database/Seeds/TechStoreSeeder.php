<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TechStoreSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Clear existing data (Deleting book data)
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('products')->truncate();
        $db->table('product_images')->truncate();
        $db->table('admin_notes')->truncate();
        $db->table('shops')->truncate();
        $db->table('categories')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        $db->query("ALTER TABLE categories AUTO_INCREMENT = 1");
        $db->query("ALTER TABLE shops AUTO_INCREMENT = 1");
        $db->query("ALTER TABLE products AUTO_INCREMENT = 1");

        // 1. Seed Technical Categories with Icons
        $categories = [
            ['nama' => 'PC Rakitan', 'icon' => 'https://cdn-icons-png.flaticon.com/512/2493/2493301.png'],
            ['nama' => 'Laptop', 'icon' => 'https://cdn-icons-png.flaticon.com/512/2493/2493307.png'],
            ['nama' => 'MacBook & iMac', 'icon' => 'https://cdn-icons-png.flaticon.com/512/526/526951.png'],
            ['nama' => 'Processor', 'icon' => 'https://cdn-icons-png.flaticon.com/512/984/984442.png'],
            ['nama' => 'Graphic Card', 'icon' => 'https://cdn-icons-png.flaticon.com/512/11152/11152748.png'],
            ['nama' => 'Memory (RAM)', 'icon' => 'https://cdn-icons-png.flaticon.com/512/11152/11152764.png'],
            ['nama' => 'Storage', 'icon' => 'https://cdn-icons-png.flaticon.com/512/11153/11153084.png'],
            ['nama' => 'Motherboard', 'icon' => 'https://cdn-icons-png.flaticon.com/512/908/908742.png'],
            ['nama' => 'Monitor', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3474/3474362.png'],
            ['nama' => 'Aksesoris', 'icon' => 'https://cdn-icons-png.flaticon.com/512/3419/3419120.png']
        ];
        
        foreach ($categories as $cat) {
            $db->table('categories')->insert([
                'nama_kategori' => $cat['nama'],
                'icon'          => $cat['icon']
            ]);
        }
        
        // Get Category IDs
        $catMap = [];
        foreach ($db->table('categories')->get()->getResultArray() as $row) {
            $catMap[$row['nama_kategori']] = $row['id'];
        }

        // 2. Create 10 Tech Shops
        $userPenjual = $db->table('users')->where('role', 'penjual')->get()->getResultArray();
        
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
            $uId = isset($userPenjual[$index]) ? $userPenjual[$index]['id'] : 1;
            $db->table('shops')->insert([
                'user_id' => $uId,
                'nama_toko' => $s['name'],
                'deskripsi_toko' => $s['desc'],
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        $shopIds = array_column($db->table('shops')->get()->getResultArray(), 'id');

        // 3. Tech Products Data with Specs
        $tech_items = [
            'PC Rakitan' => [
                ['PC Gaming Ryzen 5 RTX 3060', 12500000, 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=500', "Processor: Ryzen 5 5600X\nGPU: RTX 3060 12GB\nRAM: 16GB DDR4 3200MHz\nStorage: NVMe 500GB\nPSU: 550W 80+ Bronze"],
                ['Workstation Intel Core i9 Gen 13', 25000000, 'https://images.unsplash.com/photo-1593640408182-31c70c8228f5?w=500', "Processor: Intel Core i9-13900K\nRAM: 64GB DDR5 5200MHz\nGPU: Quadro RTX A4000\nStorage: 2TB Gen4 NVMe\nOS: Windows 11 Pro"],
            ],
            'Laptop' => [
                ['ASUS ROG Zephyrus G14', 18900000, 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500', "Screen: 14\" QHD 120Hz\nCPU: Ryzen 9 5900HS\nGPU: RTX 3060\nRAM: 16GB\nSSD: 1TB"],
                ['Lenovo Legion Slim 5', 16500000, 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500', "Processor: Ryzen 7 7840HS\nGPU: RTX 4060\nRAM: 16GB\nStorage: 512GB SSD"],
            ],
            'MacBook & iMac' => [
                ['MacBook Pro M2 14-inch', 28500000, 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500', "Chip: Apple M2 Pro (10-core CPU)\nRAM: 16GB Unified Memory\nStorage: 512GB SSD\nDisplay: Liquid Retina XDR 14.2-inch"],
                ['iMac 24-inch M3 Chip', 22900000, 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500', "Chip: M3 8-Core CPU\nRAM: 8GB\nStorage: 256GB SSD\nDisplay: 4.5K Retina 24-inch"],
            ],
            'Processor' => [
                ['AMD Ryzen 7 5800X', 4200000, 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=500', "Socket: AM4\nCores/Threads: 8/16\nBase Clock: 3.8GHz\nBoost Clock: 4.7GHz\nTDP: 105W"],
                ['Intel Core i5-12400F', 2400000, 'https://images.unsplash.com/photo-1555617766-c94804975da3?w=500', "Socket: LGA1700\nCores: 6 (Performance)\nThreads: 12\nBase Frequency: 2.5GHz\nL3 Cache: 18MB"],
            ],
            'Graphic Card' => [
                ['NVIDIA RTX 4070 Ti 12GB', 13500000, 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=500', "VRAM: 12GB GDDR6X\nBus: 192-bit\nInterface: PCIe 4.0\nRecommended PSU: 750W"],
                ['NVIDIA RTX 3050 8GB OC', 3800000, 'https://images.unsplash.com/photo-1624701928517-44c8ac49d93c?w=500', "VRAM: 8GB GDDR6\nCuda Cores: 2560\nPower Connectors: 1x 8-pin"],
            ],
            'Monitor' => [
                ['LG UltraGear 24-inch 144Hz', 2400000, 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500', "Size: 24 Inch\nResolution: FHD (1920x1080)\nRefresh Rate: 144Hz\nPanel Type: IPS\nResponse Time: 1ms"],
            ],
            'Motherboard' => [
                ['ASUS ROG Strix B550-F Gaming', 2900000, 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=500', "Chipset: AMD B550\nSocket: AM4\nRAM: 4x DDR4 (128GB Max)\nFeatures: PCIe 4.0, WiFi 6"],
            ],
            'Memory (RAM)' => [
                ['Corsair Vengeance LPX 16GB (2x8GB)', 1100000, 'https://images.unsplash.com/photo-1541029071515-84cc54f84dc5?w=500', "Capacity: 16GB (2x8GB)\nSpeed: 3200MHz\nLatency: CL16\nType: DDR4"],
            ],
            'Storage' => [
                ['Samsung 980 Pro 1TB NVMe', 1850000, 'https://images.unsplash.com/photo-1544244015-0cd4b3ff2091?w=500', "Capacity: 1TB\nInterface: PCIe Gen 4.0 x4\nRead Speed: 7000MB/s\nWrite Speed: 5000MB/s"],
            ],
            'Aksesoris' => [
                ['Logitech G Pro X Superlight', 1950000, 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500', "Type: Wireless Gaming Mouse\nWeight: <63g\nSensor: HERO 25K\nBattery Life: 70 Hours"],
            ]
        ];

        // Additional generic images for slides
        $extra_images = [
            'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=500',
            'https://images.unsplash.com/photo-1542751371-adc38048a05e?w=500',
            'https://images.unsplash.com/photo-1551645120-d70bfe84c826?w=500'
        ];

        $genres = array_keys($tech_items);

        foreach ($shopIds as $index => $shopId) {
            $countPerShop = 20; // 20 products per shop
            for ($i = 1; $i <= $countPerShop; $i++) {
                $catName = $genres[array_rand($genres)];
                $sample = $tech_items[$catName][array_rand($tech_items[$catName])];

                $db->table('products')->insert([
                    'shop_id' => $shopId,
                    'category_id' => $catMap[$catName] ?? 1,
                    'nama_produk' => $sample[0] . " " . ($index+1) . "." . $i,
                    'deskripsi' => $sample[0] . " performa handal dan terpercaya. Cocok untuk kebutuhan gaming maupun produktivitas tinggi. Garansi resmi 1 tahun.",
                    'spesifikasi' => $sample[3],
                    'harga' => $sample[1] + rand(-200000, 200000),
                    'stok' => rand(5, 50),
                    'foto_url' => $sample[2],
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $pId = $db->insertID();

                // Seed 2 additional images per product
                foreach (array_slice($extra_images, 0, 2) as $imgUrl) {
                    $db->table('product_images')->insert([
                        'product_id' => $pId,
                        'foto_url'   => $imgUrl,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
