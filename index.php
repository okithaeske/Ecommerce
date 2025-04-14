<?php
$base = './'; // update if hosted inside a folder
include 'components/header.php';

$page = $_GET['page'] ?? 'home';
$category = $_GET['category'] ?? null;

// Routing logic
switch ($page) {
    case 'product':
        include 'view/product.php';
        break;
    case 'add':
        include 'admin/add.php';
        break;
    case 'update':
        include 'admin/update.php';
        break;
    case 'delete':
        include 'admin/delete.php';
        break;
    case 'contact':
        include 'view/contact.php';
        break;
    case 'about':
        include 'view/about.php';
        break;
    default:
        include 'view/index.php';
        break;
}
