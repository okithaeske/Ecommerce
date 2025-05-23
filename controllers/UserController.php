<?php
require_once 'models/OrderModel.php';
require_once 'models/ProductModel.php';

class UserController
{
    public function checkout()
    {


        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header("Location: cart");
            exit;
        }

        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $products = [];
        $total = 0;
        $ids = array_keys($cart);
        $fetchedProducts = $productModel->getProductsByIds($ids); // ✅ use new method

        foreach ($fetchedProducts as $row) {
            $row['quantity'] = $cart[$row['product_id']];
            $row['subtotal'] = $row['Price'] * $row['quantity'];
            $total += $row['subtotal'];
            $products[] = $row;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'] ?? null;
            if (!$user_id) {
                header("Location: login");
                exit;
            }

            // ✅ Sanitize using PHP functions (PDO handles SQL safely)
            $fullname = htmlspecialchars(trim($_POST['fullname']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));

            $order_id = $orderModel->createOrder($user_id, $fullname, $email, $address, $total);
            $orderModel->addOrderItems($order_id, $products);

            $_SESSION['cart'] = [];
            header("Location: thankyou");
            exit;
        }

        include 'view\checkout.php';
    }

    

    // Fetch total number of user
}
