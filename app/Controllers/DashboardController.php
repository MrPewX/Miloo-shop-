<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role === 'penjual') {
            return redirect()->to('/seller/dashboard');
        } else {
            return view('dashboard/customer');
        }
    }
}
