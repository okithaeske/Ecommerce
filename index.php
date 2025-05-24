<?php
require_once 'controllers/AuthControllers.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/SellerController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/AdminController.php';

$page = $_GET['page'] ?? 'home';
$category = $_GET['category'] ?? null;

switch ($page) {
    case 'login':
        (new AuthController())->login();
        break;
    case 'registerUser':
        (new AuthController())->RegisterN();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'products':
        (new ProductController())->show();
        break;
    case 'add':
        (new SellerController())->add();
        break;
    case 'delete':
        (new SellerController())->delete();
        break;
    case 'update':
        (new SellerController())->update();
        break;
    case 'dashboard':
        (new SellerController())->dashboard();
        break;
    case 'checkout':
        (new UserController())->checkout();
        break;
    case 'admin_dashboard':
        (new AdminController())->dashboard();
        break;
    case 'storeRegister':
        (new AuthController())->RegisterStore();
        break;
    

   
    case 'add_to_cart':
        include 'user/add_to_cart.php'; 
        break;
    case 'thankyou':
        include 'user/thankyou.php';
        break;
    case 'register':
        include 'auth/register.php';
        break;
    case 'store_register':
        include 'auth/store_register.php';
        break;  
    case 'about':
    case 'contact':
    case 'home':
    default:
        include 'view/' . $page . '.php'; // fallback for simple views
        break;
}
