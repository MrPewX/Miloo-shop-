<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SellerController extends BaseController
{
    public function index()
    {
        $shopModel = new \App\Models\ShopModel();
        $shop = $shopModel->where('user_id', session()->get('user_id'))->first();

        if (!$shop) {
            return redirect()->to('/seller/open-shop');
        }

        $adminNoteModel = new \App\Models\AdminNoteModel();
        $notes = $adminNoteModel->where('shop_id', $shop['id'])->orderBy('created_at', 'DESC')->findAll();

        return view('seller/dashboard', [
            'shop' => $shop,
            'notes' => $notes
        ]);
    }

    public function products()
    {
        $shopModel = new \App\Models\ShopModel();
        $shop = $shopModel->where('user_id', session()->get('user_id'))->first();
        
        $productModel = new \App\Models\ProductModel();
        $data['products'] = $productModel->where('shop_id', $shop['id'])->findAll();
        
        return view('seller/products', $data);
    }

    public function notes()
    {
        $shopModel = new \App\Models\ShopModel();
        $shop = $shopModel->where('user_id', session()->get('user_id'))->first();
        
        if (!$shop) return redirect()->to('/');

        $adminNoteModel = new \App\Models\AdminNoteModel();
        $data['notes'] = $adminNoteModel->where('shop_id', $shop['id'])->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Notifikasi Admin';
        
        return view('seller/notes', $data);
    }

    public function orders()
    {
        $shopModel = new \App\Models\ShopModel();
        $shop = $shopModel->where('user_id', session()->get('user_id'))->first();
        
        if (!$shop) return redirect()->to('/');

        // Placeholder for orders (actual implementation would use an Order model)
        $data['orders'] = []; 
        $data['title'] = 'Pesanan Masuk';
        return view('seller/orders', $data);
    }
}
