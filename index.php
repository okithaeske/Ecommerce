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
    case 'delete':
        include 'seller/delete.php';
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
    default:
        include 'view/home.php';
        break;
}

