<?php
session_start();

require_once 'models/ProductModel.php';  // Assuming you have a ProductModel to fetch product details

class CartController
{

    public function __construct()
    {
        // Initialize any necessary properties here
    }

    public function showCart()
    {
        $cart = $_SESSION['cart'] ?? [];
        $productModel = new ProductModel();
        $products = [];

        if (!empty($cart)) {
            $ids = implode(",", array_map('intval', array_keys($cart)));
            $result = $productModel->getProductsByIds($ids);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $row['quantity'] = $cart[$row['product_id']];
                $products[] = $row;
            }
        }

        require_once 'views/cart.php';  // Load the view
    }

    public function updateCart($productId, $quantity)
    {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);  // Remove item if quantity is 0 or less
        } else {
            $_SESSION['cart'][$productId] = $quantity;  // Update the quantity
        }
        header("Location: cart.php");  // Redirect back to the cart page
    }

    public function removeFromCart($productId)
    {
        unset($_SESSION['cart'][$productId]);  // Remove product from cart
        header("Location: cart.php");  // Redirect back to the cart page
    }

    public function adjustCart($productId, $action)
    {
        if (isset($_SESSION['cart'][$productId])) {
            if ($action === 'add') {
                $_SESSION['cart'][$productId]++;
            } elseif ($action === 'subtract') {
                $_SESSION['cart'][$productId]--;
                if ($_SESSION['cart'][$productId] <= 0) {
                    unset($_SESSION['cart'][$productId]);
                }
            } elseif ($action === 'remove') {
                unset($_SESSION['cart'][$productId]);
            }
        }
        header("Location: cart");
        exit;
    }




}
