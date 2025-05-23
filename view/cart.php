<?php

require_once 'models/ProductModel.php';  // Include the ProductModel to use its methods

$productModel = new ProductModel();  // Initialize the ProductModel
$cart = $_SESSION['cart'] ?? [];
$total = 0;

// Handle cart updates (add, remove, and minimize)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        $_SESSION['cart'] = $cart;
    } elseif (isset($_POST['remove_from_cart'])) {
        $productId = $_POST['product_id'];
        unset($cart[$productId]);
        $_SESSION['cart'] = $cart;
    } elseif (isset($_POST['minimize_quantity'])) {
        $productId = $_POST['product_id'];
        if ($cart[$productId] > 1) {
            $cart[$productId]--;
        } else {
            unset($cart[$productId]);
        }
        $_SESSION['cart'] = $cart;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50">

    <section class="w-screen max-w-7xl mx-auto px-6 py-12 bg-[#F9FAFB]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-900 border-b pb-2">Your Cart</h2>
        </div>

        <?php if (empty($cart)): ?>
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <p class="text-xl text-gray-700">Your cart is empty.</p>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($cart as $productId => $quantity):
                    $product = $productModel->getProductById($productId);  // Fetch product details using the model
                    $total += $product['Price'] * $quantity;
                    ?>
                    <div class="flex items-center justify-between bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                        <div class="flex items-center">
                            <!-- Display base64 image -->
                            <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>"
                                alt="<?= $product['Name'] ?>" class="w-20 h-20 object-cover rounded-lg mr-6">
                            <div>
                                <p class="font-semibold text-lg text-gray-800"><?= htmlspecialchars($product['Name']) ?></p>
                                <p class="text-sm text-gray-500">Price: $<?= number_format($product['Price'], 2) ?></p>
                                <p class="text-sm text-gray-500">Quantity: <?= $quantity ?></p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Remove product button -->
                            <form action="" method="POST" class="inline-block">
                                <input type="hidden" name="product_id" value="<?= $productId ?>">
                                <button type="submit" name="remove_from_cart" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">🗑️</button>
                            </form>

                            <!-- Minimize quantity button -->
                            <form action="" method="POST" class="inline-block">
                                <input type="hidden" name="product_id" value="<?= $productId ?>">
                                <button type="submit" name="minimize_quantity" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">➖</button>
                            </form>

                            <!-- Add product button -->
                            <form action="" method="POST" class="inline-block">
                                <input type="hidden" name="product_id" value="<?= $productId ?>">
                                <button type="submit" name="add_to_cart" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">➕</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Total and Checkout -->
            <div class="flex justify-between items-center mt-8 bg-white p-6 rounded-lg shadow-lg">
                <p class="font-semibold text-xl">Total: $<?= number_format($total, 2) ?></p>
                <a href="checkout" class="bg-black text-white px-8 py-3 rounded-lg hover:bg-gray-800 transition-colors">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- Link to continue shopping -->
    <div class="text-center mb-4">
        <a href="products" class="text-blue-600 text-lg font-semibold">← Continue Shopping</a>
    </div>

</body>

</html>
