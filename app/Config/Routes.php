<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Main Marketplace Routes
$routes->get('/', 'Home::index');
$routes->get('category/(:num)', 'Home::index/$1');
$routes->get('product/(:num)', 'Home::detail/$1');
$routes->get('shop/(:num)', 'Home::shop/$1');

// Cart Routes (Guest access allowed for browsing, auth needed for actions potentially)
$routes->group('cart', function($routes) {
    $routes->get('/', 'CartController::index');
    $routes->post('add', 'CartController::add');
    $routes->post('update', 'CartController::update');
    $routes->get('delete/(:num)', 'CartController::delete/$1');
});

// Auth Routes
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('logout', 'AuthController::logout');

// Dashboard Routes
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// Checkout Routes
$routes->get('checkout', 'CheckoutController::index', ['filter' => 'auth']);
$routes->get('checkout/process', 'CheckoutController::process', ['filter' => 'auth']);

// Admin Routes
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('content', 'AdminController::content');
    $routes->get('shops', 'AdminController::shops');
    $routes->get('products', 'AdminController::products');
    $routes->get('users', 'AdminController::users');
    $routes->get('reports', 'AdminController::reports');
    
    // Admin Actions
    $routes->post('block-shop/(:num)', 'AdminController::blockShop/$1');
    $routes->post('warn-shop/(:num)', 'AdminController::warnShop/$1');
    $routes->post('delete-product/(:num)', 'AdminController::deleteProduct/$1');
    
    // Admin Management from Product Detail
    $routes->post('update-product-data/(:num)', 'AdminController::updateProductData/$1');
    $routes->post('add-product-image/(:num)', 'AdminController::addProductImage/$1');
    $routes->get('delete-product-image/(:num)', 'AdminController::deleteProductImage/$1');
    $routes->post('delete-main-image/(:num)', 'AdminController::deleteMainImage/$1');
    $routes->get('delete-review/(:num)', 'AdminController::deleteReview/$1');
    $routes->post('add-category', 'AdminController::addCategory');
    
    // User Management
    $routes->post('delete-user/(:num)', 'AdminController::deleteUser/$1');
    $routes->post('update-user/(:num)', 'AdminController::updateUser/$1');
});

// Seller Routes
$routes->group('seller', ['filter' => 'auth:penjual'], function($routes) {
    $routes->get('dashboard', 'SellerController::index');
    $routes->get('products', 'SellerController::products');
    $routes->get('notes', 'SellerController::notes');
});
