<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/home':
        include 'view/home.php';
        break;
    case '/about':
        include 'view/about.php';
        break;
    case '/products':
        include 'view/product.php';
        break;
    case '/add':
        include 'seller/add.php';
        break;
    case '/update':
        include 'seller/update.php';
        break;
    case '/delete':
        include 'seller/delete.php';
        break;
    case '/contact':
        include 'view/contact.php';
        break;
    case '/login':
        include 'auth/login.php';
        break;
    case '/store_register':
        include 'auth/store_register.php';
        break;
    case '/register':
        include 'auth/register.php';
        break;
    default:
        include 'view/404.php';
        break;
}
