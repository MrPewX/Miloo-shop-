<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function shops()
    {
        $shopModel = new \App\Models\ShopModel();
        $sort = $this->request->getGet('sort') ?: 'id_desc';
        
        $builder = $shopModel;
        
        switch($sort) {
            case 'name_asc': $builder->orderBy('nama_toko', 'ASC'); break;
            case 'name_desc': $builder->orderBy('nama_toko', 'DESC'); break;
            case 'date_asc': $builder->orderBy('created_at', 'ASC'); break;
            case 'date_desc': $builder->orderBy('created_at', 'DESC'); break;
            default: $builder->orderBy('id', 'DESC'); break;
        }

        $data['shops'] = $builder->findAll();
        $data['title'] = 'Daftar Toko';
        $data['current_sort'] = $sort;
        return view('admin/shops', $data);
    }

    public function users()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['title'] = 'Daftar Pengguna';
        return view('admin/users', $data);
    }

    public function content()
    {
        $data['title'] = 'Manajemen Konten';
        return view('admin/content', $data);
    }

    public function products()
    {
        $productModel = new \App\Models\ProductModel();
        $rawProducts = $productModel->select('products.*, shops.nama_toko')
                                   ->join('shops', 'shops.id = products.shop_id')
                                   ->findAll();
        
        // Group by shop
        $grouped = [];
        foreach ($rawProducts as $p) {
            $grouped[$p['nama_toko']][] = $p;
        }

        $data['grouped_products'] = $grouped;
        $data['title'] = 'Moderasi Produk';
        return view('admin/products', $data);
    }

    public function reports()
    {
        $data['title'] = 'Laporan Penjualan';
        return view('admin/reports', $data);
    }

    public function blockShop($id)
    {
        $shopModel = new \App\Models\ShopModel();
        $shopModel->update($id, ['status' => 'blocked']);
        
        // Also deactivate all products of this shop
        $productModel = new \App\Models\ProductModel();
        $productModel->where('shop_id', $id)->set(['status' => 'inactive'])->update();
        
        return redirect()->back()->with('message', 'Toko dan semua produknya berhasil diblokir.');
    }

    public function warnShop($id)
    {
        $note = $this->request->getGet('note');
        $db = \Config\Database::connect();
        $db->table('admin_notes')->insert([
            'shop_id' => $id,
            'note' => $note,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('message', 'Teguran berhasil dikirim.');
    }

    public function deleteProduct($id)
    {
        $productModel = new \App\Models\ProductModel();
        $productModel->delete($id);
        return redirect()->back()->with('message', 'Produk berhasil dihapus.');
    }

    public function updateProductData($id)
    {
        $productModel = new \App\Models\ProductModel();
        $data = [];
        
        if ($this->request->getPost('deskripsi') !== null) $data['deskripsi'] = $this->request->getPost('deskripsi');
        if ($this->request->getPost('spesifikasi') !== null) $data['spesifikasi'] = $this->request->getPost('spesifikasi');
        if ($this->request->getPost('category_id') !== null) $data['category_id'] = $this->request->getPost('category_id');
        if ($this->request->getPost('status') !== null) $data['status'] = $this->request->getPost('status');

        if (!empty($data)) {
            $productModel->update($id, $data);
        }
        
        return redirect()->back()->with('message', 'Data produk berhasil diupdate.');
    }

    public function deleteMainImage($id)
    {
        $productModel = new \App\Models\ProductModel();
        $productModel->update($id, ['foto_url' => '']);
        return redirect()->back()->with('message', 'Gambar utama dihapus.');
    }

    public function addProductImage($id)
    {
        $url = $this->request->getPost('url');
        $file = $this->request->getFile('file_image');
        
        $finalUrl = $url;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/products', $newName);
            $finalUrl = '/uploads/products/' . $newName;
        }

        if (empty($finalUrl)) {
            return redirect()->back()->with('error', 'Pilih file atau masukkan URL.');
        }

        $imageModel = new \App\Models\ProductImageModel();
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);

        if (empty($product['foto_url'])) {
            $productModel->update($id, ['foto_url' => $finalUrl]);
        } else {
            $imageModel->insert([
                'product_id' => $id,
                'foto_url' => $finalUrl
            ]);
        }
        return redirect()->back()->with('message', 'Gambar berhasil ditambahkan.');
    }

    public function deleteProductImage($id)
    {
        $imageModel = new \App\Models\ProductImageModel();
        $imageModel->delete($id);
        return redirect()->back()->with('message', 'Gambar berhasil dihapus.');
    }

    public function deleteReview($id)
    {
        $reviewModel = new \App\Models\ReviewModel();
        $reviewModel->delete($id);
        return redirect()->back()->with('message', 'Ulasan berhasil dihapus.');
    }

    public function addCategory()
    {
        $nama = $this->request->getPost('nama_kategori');
        $icon = $this->request->getPost('icon'); // This could be an emoji or font-awesome class
        
        $catModel = new \App\Models\CategoryModel();
        $catModel->insert([
            'nama_kategori' => $nama,
            'icon' => $icon
        ]);
        return redirect()->back()->with('message', 'Kategori baru ditambahkan.');
    }

    public function deleteUser($id)
    {
        if (session()->get('user_id') == $id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus diri sendiri.');
        }

        $userModel = new \App\Models\UserModel();
        $userModel->delete($id);
        return redirect()->back()->with('message', 'Pengguna berhasil dihapus.');
    }

    public function updateUser($id)
    {
        $userModel = new \App\Models\UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        $pw = $this->request->getPost('password');
        if (!empty($pw)) {
            $data['password'] = password_hash($pw, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);
        return redirect()->back()->with('message', 'Data pengguna berhasil diperbarui.');
    }
}
