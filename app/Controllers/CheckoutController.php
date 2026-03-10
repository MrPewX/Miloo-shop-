<?php

namespace App\Controllers;

class CheckoutController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id = $this->request->getGet('id');
        $qty = $this->request->getGet('qty') ?: 1;

        $checkoutItems = [];
        $total = 0;

        if ($id) {
            // Direct Buy Mode
            $productModel = new \App\Models\ProductModel();
            $product = $productModel->find($id);
            if ($product) {
                $checkoutItems[] = [
                    'id'    => $product['id'],
                    'name'  => $product['nama_produk'],
                    'price' => $product['harga'],
                    'qty'   => $qty,
                    'img'   => $product['foto_url'] ?: 'https://via.placeholder.com/300'
                ];
                $total = $product['harga'] * $qty;
            }
        } else {
            // Cart Mode
            $cart = session()->get('cart') ?: [];
            foreach ($cart as $pId => $item) {
                $checkoutItems[] = [
                    'id'    => $pId,
                    'name'  => $item['name'],
                    'price' => $item['price'],
                    'qty'   => $item['qty'],
                    'img'   => $item['img']
                ];
                $total += $item['price'] * $item['qty'];
            }
        }

        if (empty($checkoutItems)) {
            return redirect()->to('/')->with('error', 'Tidak ada barang untuk di-checkout.');
        }

        $data['checkout_items'] = $checkoutItems;
        $data['total'] = $total;
        $data['shipping'] = 50000; // Fixed shipping for demo
        $data['grand_total'] = $total + $data['shipping'];

        return view('checkout/index', $data);
    }

    public function process()
    {
        // Clear cart after checkout
        session()->remove('cart');
        return view('checkout/payment_success');
    }
}
