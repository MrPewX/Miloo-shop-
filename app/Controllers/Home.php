<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($categoryId = null)
    {
        $productModel = new \App\Models\ProductModel();
        $query = $this->request->getGet('q');
        
        $builder = $productModel->select('products.*, categories.nama_kategori')
                               ->join('categories', 'categories.id = products.category_id');
        
        // Category Filter
        if ($categoryId) {
            $builder->where('category_id', $categoryId);
        }

        // Search Engine
        if ($query) {
            $builder->groupStart()
                    ->like('nama_produk', $query)
                    ->orLike('deskripsi', $query)
                    ->orLike('spesifikasi', $query)
                    ->orLike('categories.nama_kategori', $query)
                    ->groupEnd();
        }

        $dbProducts = $builder->orderBy('id', 'RANDOM')->findAll(30);

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

        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->findAll();

        return view('index', [
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query,
            'activeCategory' => $categoryId
        ]);
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
