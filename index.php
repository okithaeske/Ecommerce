<?php
$base = './'; // update if hosted inside a folder

$page = $_GET['page'] ?? 'home';
$category = $_GET['category'] ?? null;


// Routing logic
switch ($page) {
    case 'products':
        include 'view/product.php';
        break;
    case 'add':
        include 'seller/add.php';
        break;
    case 'update':
        include 'seller/update.php';
        break;
    case 'dashboard':
        include 'seller/dashboard.php';
        break;
    case 'contact':
        include 'view/contact.php';
        break;
    case 'about':
        include 'view/about.php';
        break;
    case 'login':
        include 'auth/login.php';
        break;
    case 'roleselection':
        include 'auth/roleselection.php';
        break;
    case 'register':
        include 'auth/register.php';
        break;
    case 'store_register':
        include 'auth/store_register.php';
        break;
    case 'update_product':
        include 'seller/update_product.php';
        break;
    case 'cart':
        include 'user/cart.php';
        break;
    case 'add_to_cart':
        include 'user/add_to_cart.php';
        break;
    case 'update_cart':
        include 'user/update_cart.php';
        break;
    case 'logout':
        include 'auth/logout.php';
        break;
    default:
        include 'view/home.php';
        break;


        
}


