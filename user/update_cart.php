<?php
session_start();

$product_id = $_POST['product_id'];
$action = $_POST['action'];

if (isset($_SESSION['cart'][$product_id])) {
    if ($action === 'add') {
        $_SESSION['cart'][$product_id]++;
    } elseif ($action === 'subtract') {
        $_SESSION['cart'][$product_id]--;
        if ($_SESSION['cart'][$product_id] <= 0) {
            unset($_SESSION['cart'][$product_id]);
        }
    } elseif ($action === 'remove') {
        unset($_SESSION['cart'][$product_id]);
    }
}

header("Location: cart");
exit;
