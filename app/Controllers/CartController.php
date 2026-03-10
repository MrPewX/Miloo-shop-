<?php

namespace App\Controllers;

class CartController extends BaseController
{
    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?: [];
        
        $productModel = new \App\Models\ProductModel();
        
        $cartData = [];
        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = $productModel->select('products.*, shops.nama_toko')
                                   ->join('shops', 'shops.id = products.shop_id')
                                   ->find($productId);
            
            if ($product) {
                $shopName = $product['nama_toko'];
                if (!isset($cartData[$shopName])) {
                    $cartData[$shopName] = [];
                }
                
                $subtotal = $product['harga'] * $qty;
                $total += $subtotal;
                
                $cartData[$shopName][] = [
                    'id' => $product['id'],
                    'name' => $product['nama_produk'],
                    'price' => $product['harga'],
                    'qty' => $qty,
                    'img' => $product['foto_url'],
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('cart', [
            'cartGroups' => $cartData,
            'total' => $total
        ]);
    }

    public function add()
    {
        $productId = $this->request->getPost('product_id');
        $qty = $this->request->getPost('qty') ?: 1;
        
        $session = session();
        $cart = $session->get('cart') ?: [];
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $qty;
        } else {
            $cart[$productId] = $qty;
        }
        
        $session->set('cart', $cart);
        return redirect()->back()->with('message', 'Produk ditambahkan ke keranjang');
    }

    public function update()
    {
        $productId = $this->request->getPost('product_id');
        $action = $this->request->getPost('action'); // 'plus' or 'minus'
        
        $session = session();
        $cart = $session->get('cart') ?: [];
        
        if (isset($cart[$productId])) {
            if ($action === 'plus') {
                $cart[$productId]++;
            } else if ($action === 'minus' && $cart[$productId] > 1) {
                $cart[$productId]--;
            }
        }
        
        $session->set('cart', $cart);
        return redirect()->to('/cart');
    }

    public function delete($id)
    {
        $session = session();
        $cart = $session->get('cart') ?: [];
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        
        $session->set('cart', $cart);
        return redirect()->to('/cart');
    }
}
