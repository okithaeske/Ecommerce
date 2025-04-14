<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/home':
        include 'view/index.php';
        break;
    case '/about':
        include 'view/about.php';
        break;
    case '/old':
        include 'view/product.php';
        break;
    case 'product/lux':
        include 'view/product.php';
        break;
    case '/product/modern':
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
    default:
        include 'view/404.php';
        break;
}
