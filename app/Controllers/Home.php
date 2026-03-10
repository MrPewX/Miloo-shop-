<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($categoryId = null)
    {
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();
        $query = $this->request->getGet('q');
        
        $categories = $categoryModel->findAll();
        
        if ($categoryId || $query) {
            $builder = $productModel->select('products.*, categories.nama_kategori')
                                   ->join('categories', 'categories.id = products.category_id');
            
            if ($categoryId) {
                $builder->where('category_id', $categoryId);
            }

            if ($query) {
                $builder->groupStart()
                        ->like('nama_produk', $query)
                        ->orLike('deskripsi', $query)
                        ->orLike('spesifikasi', $query)
                        ->orLike('categories.nama_kategori', $query)
                        ->groupEnd();
            }

            $dbProducts = $builder->orderBy('id', 'DESC')->findAll();
            
            return view('index', [
                'products' => $this->formatProducts($dbProducts),
                'categories' => $categories,
                'searchQuery' => $query,
                'activeCategory' => $categoryId,
                'groupedProducts' => null
            ]);
        }

        // Default Landling: Grouped by Category
        $groupedProducts = [];
        foreach ($categories as $cat) {
            $dbCatProducts = $productModel->where('category_id', $cat['id'])
                                         ->orderBy('id', 'DESC')
                                         ->findAll(10);
            
            if (!empty($dbCatProducts)) {
                $groupedProducts[] = [
                    'category' => $cat,
                    'items' => $this->formatProducts($dbCatProducts)
                ];
            }
        }

        return view('index', [
            'products' => [], 
            'categories' => $categories,
            'searchQuery' => $query,
            'activeCategory' => $categoryId,
            'groupedProducts' => $groupedProducts
        ]);
    }

    private function formatProducts($dbProducts)
    {
        $products = [];
        foreach ($dbProducts as $p) {
            $products[] = [
                'id' => $p['id'],
                'shop_id' => $p['shop_id'],
                'name' => $p['nama_produk'],
                'price' => 'Rp ' . number_format($p['harga'], 0, ',', '.'),
                'img' => $p['foto_url'] ?: 'https://via.placeholder.com/400',
                'location' => 'Indonesia',
                'rating' => '4.8 | 100+ terjual',
                'status' => $p['status']
            ];
        }
        return $products;
    }

    public function detail($id)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->select('products.*, categories.nama_kategori, shops.nama_toko, shops.deskripsi_toko, shops.user_id')
                               ->join('categories', 'categories.id = products.category_id')
                               ->join('shops', 'shops.id = products.shop_id')
                               ->find($id);

        if (!$product) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan');
        }

        $reviewModel = new \App\Models\ReviewModel();
        $reviews = $reviewModel->select('reviews.*, users.username')
                              ->join('users', 'users.id = reviews.user_id')
                              ->where('product_id', $id)
                              ->orderBy('reviews.created_at', 'DESC')
                              ->findAll();

        $imageModel = new \App\Models\ProductImageModel();
        $images = $imageModel->where('product_id', $id)->findAll();

        $categoryModel = new \App\Models\CategoryModel();
        $allCategories = $categoryModel->findAll();

        return view('product_detail', [
            'product' => $product,
            'reviews' => $reviews,
            'images'  => $images,
            'allCategories' => $allCategories
        ]);
    }

    public function shop($id)
    {
        $shopModel = new \App\Models\ShopModel();
        $shop = $shopModel->find($id);

        if (!$shop) {
            return redirect()->to('/')->with('error', 'Toko tidak ditemukan');
        }

        $productModel = new \App\Models\ProductModel();
        $dbProducts = $productModel->where('shop_id', $id)->findAll();

        $products = [];
        foreach ($dbProducts as $p) {
            $products[] = [
                'id' => $p['id'],
                'name' => $p['nama_produk'],
                'price' => 'Rp ' . number_format($p['harga'], 0, ',', '.'),
                'img' => $p['foto_url'],
                'status' => $p['status']
            ];
        }

        return view('shop_profile', [
            'shop' => $shop,
            'products' => $products
        ]);
    }
}
