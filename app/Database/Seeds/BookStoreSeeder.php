<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookStoreSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Clear existing data for a clean bookstore start
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('products')->truncate();
        $db->table('admin_notes')->truncate();
        $db->table('shops')->truncate();
        $db->table('categories')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');
        $db->query("ALTER TABLE categories AUTO_INCREMENT = 1");
        $db->query("ALTER TABLE shops AUTO_INCREMENT = 1");
        $db->query("ALTER TABLE products AUTO_INCREMENT = 1");

        // 1. Seed Categories
        $categories = [
            'Novel & Sastra', 'Komik & Manga', 'Buku Pelajaran', 'Bisnis & Ekonomi', 
            'Pengembangan Diri', 'Agama & Spiritualitas', 'Teknologi & Komputer', 
            'Anak-anak', 'Kuliner & Resep', 'Sejarah & Politik'
        ];
        
        foreach ($categories as $cat) {
            $db->table('categories')->insert(['nama_kategori' => $cat]);
        }
        
        // Get Category IDs
        $catMap = [];
        foreach ($db->table('categories')->get()->getResultArray() as $row) {
            $catMap[$row['nama_kategori']] = $row['id'];
        }

        // 2. Create 10 Shops (5 specialized, 5 mixed)
        // We need users for these shops. Let's reuse user_id 2 (penjual) or create more.
        // For simplicity, I'll assign to user_id 2 or 3 (if exist).
        $userPenjual = $db->table('users')->where('role', 'penjual')->get()->getRowArray();
        if (!$userPenjual) {
            // Create a default penjual if none exists
            $db->table('users')->insert([
                'username' => 'penjual_pustaka',
                'email' => 'seller@pustaka.com',
                'password' => password_hash('seller123', PASSWORD_DEFAULT),
                'role' => 'penjual'
            ]);
            $userId = $db->insertID();
        } else {
            $userId = $userPenjual['id'];
        }

        $shopsData = [
            ['name' => 'Litera Novel Shop', 'desc' => 'Spesialis Novel & Sastra terlengkap.'],
            ['name' => 'Manga Station', 'desc' => 'Dunia Komik dan Manga terbaru.'],
            ['name' => 'EduPustaka', 'desc' => 'Koleksi Buku Pelajaran sekolah dan kampus.'],
            ['name' => 'Financial Wisdom', 'desc' => 'Investasi dan Bisnis untuk masa depan.'],
            ['name' => 'SelfGrowth Hub', 'desc' => 'Menjadi versi terbaik dirimu.'],
            ['name' => 'Toko Buku Amanah', 'desc' => 'Buku Agama dan Sejarah Islam.'],
            ['name' => 'Tech & Kids Books', 'desc' => 'Coding untuk dewasa, cerita untuk anak.'],
            ['name' => 'Dapur & Ilmu', 'desc' => 'Resep lezat dan pengetahuan bisnis.'],
            ['name' => 'Varia Pustaka', 'desc' => 'Toko buku serba ada untuk semua.'],
            ['name' => 'Griya Baca', 'desc' => 'Inspirasi dari buku-buku pilihan.'],
        ];

        foreach ($shopsData as $s) {
            $db->table('shops')->insert([
                'user_id' => $userId,
                'nama_toko' => $s['name'],
                'deskripsi_toko' => $s['desc'],
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        $shopIds = array_column($db->table('shops')->get()->getResultArray(), 'id');

        // 3. Seed Products (20 books per shop = 200 books)
        $books_data = [
            'Novel & Sastra' => [
                ['Laskar Pelangi', 'Andrea Hirata', 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400'],
                ['Bumi Manusia', 'Pramoedya Ananta Toer', 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400'],
                ['Negeri 5 Menara', 'A. Fuadi', 'https://images.unsplash.com/photo-1543004218-ee1411049350?w=400'],
                ['Hujan', 'Tere Liye', 'https://images.unsplash.com/photo-1474932430478-367dbb6832c1?w=400'],
                ['Dilan 1990', 'Pidi Baiq', 'https://images.unsplash.com/photo-1476275466078-4007374efbbe?w=400'],
            ],
            'Komik & Manga' => [
                ['One Piece Vol 100', 'Eiichiro Oda', 'https://images.unsplash.com/photo-1580436541340-36b1d40d9cb4?w=400'],
                ['Naruto Gaiden', 'Masashi Kishimoto', 'https://images.unsplash.com/photo-1618519764620-7403abdbfff9?w=400'],
                ['Doraemon Antologi', 'Fujiko F. Fujio', 'https://images.unsplash.com/photo-1588666309990-d68f08e3d4a6?w=400'],
                ['Jujutsu Kaisen', 'Gege Akutami', 'https://images.unsplash.com/photo-1614583225154-5fcdda07019e?w=400'],
                ['Attack on Titan', 'Hajime Isayama', 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=400'],
            ],
            'Bisnis & Ekonomi' => [
                ['Rich Dad Poor Dad', 'Robert Kiyosaki', 'https://images.unsplash.com/photo-1592492159418-39f319320569?w=400'],
                ['The Psychology of Money', 'Morgan Housel', 'https://images.unsplash.com/photo-1612178537253-bccd437b730e?w=400'],
                ['Zero to One', 'Peter Thiel', 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400'],
                ['Think and Grow Rich', 'Napoleon Hill', 'https://images.unsplash.com/photo-1606813359051-5ba1d8985172?w=400'],
                ['Start with Why', 'Simon Sinek', 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=400'],
            ],
            'Teknologi & Komputer' => [
                ['Clean Code', 'Robert C. Martin', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400'],
                ['Pragmatic Programmer', 'Andrew Hunt', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400'],
                ['JavaScript: The Good Parts', 'Douglas Crockford', 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=400'],
                ['Eloquent JavaScript', 'Marijn Haverbeke', 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=400'],
                ['Design Patterns', 'GoF', 'https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?w=400'],
            ],
             'Agama & Spiritualitas' => [
                ['Tafsir Al-Azhar', 'Hamka', 'https://images.unsplash.com/photo-1585036156171-384164a8c675?w=400'],
                ['La Tahzan', 'Aid Al-Qarni', 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400'],
                ['Fiqih Sunnah', 'Sayyid Sabiq', 'https://images.unsplash.com/photo-1507413245164-6160d8298b31?w=400'],
            ],
            'Pengembangan Diri' => [
                ['Atomic Habits', 'James Clear', 'https://images.unsplash.com/photo-1621351123021-7cb587a609.png?w=400'],
                ['Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400'],
            ]
        ];

        // Combine all flat for easier picking
        $all_genres = array_keys($books_data);

        foreach ($shopIds as $index => $shopId) {
            // Determine categories for this shop
            if ($index < 5) {
                // Specialized shops (Shops 0-4)
                $assignedCats = [$all_genres[$index] ?? 'Novel & Sastra'];
            } else {
                // Mixed shops (Shops 5-9)
                $assignedCats = array_slice($all_genres, $index - 5, 3);
            }

            for ($i = 1; $i <= 20; $i++) {
                $genre = $assignedCats[array_rand($assignedCats)];
                $bookList = $books_data[$genre] ?? [['Buku Umum', 'Penulis', 'https://via.placeholder.com/400']];
                $bookSample = $bookList[array_rand($bookList)];

                $db->table('products')->insert([
                    'shop_id' => $shopId,
                    'category_id' => $catMap[$genre] ?? 1,
                    'nama_produk' => $bookSample[0] . " - Part " . $i,
                    'deskripsi' => "Buku " . $bookSample[0] . " karya " . $bookSample[1] . ". Kondisi baru dan bersegel. Sangat direkomendasikan untuk koleksi bacaan Anda.",
                    'harga' => rand(45000, 250000),
                    'stok' => rand(5, 100),
                    'foto_url' => $bookSample[2],
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
