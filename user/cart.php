<?php
session_start();
include 'config/db.php';

$cart = $_SESSION['cart'] ?? [];

$products = [];

if (!empty($cart)) {
    $ids = implode(",", array_map('intval', array_keys($cart)));
    $result = $conn->query("SELECT product_id, Name, Price, Image FROM product WHERE product_id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $cart[$row['product_id']];
        $products[] = $row;
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

<body class="bg-gray-100 p-6">
    <h1 class="text-3xl mb-6 font-bold">Your Cart</h1>

    <?php if (empty($products)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($products as $item): ?>
                <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <img src="data:image/jpeg;base64,<?= base64_encode($item['Image']) ?>" class="w-20 h-20 object-contain">
                        <div>
                            <h3 class="font-semibold"><?= htmlspecialchars($item['Name']) ?></h3>
                            <p>$<?= number_format($item['Price'], 2) ?></p>
                            <p>Quantity: <?= $item['quantity'] ?></p>
                            <div class="flex space-x-2 mt-2">
                                <form action="update_cart" method="post" class="flex items-center space-x-2">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button name="action" value="add" class="px-2 bg-green-500 text-white rounded">+</button>
                                    <button name="action" value="subtract"
                                        class="px-2 bg-yellow-500 text-white rounded">−</button>
                                    <button name="action" value="remove" class="px-2 bg-red-600 text-white rounded">🗑</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="font-bold text-lg">
                        $<?= number_format($item['Price'] * $item['quantity'], 2) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php
            $total = array_reduce($products, function ($carry, $item) {
                return $carry + ($item['Price'] * $item['quantity']);
            }, 0);
            ?>

            <div class="bg-white p-4 rounded shadow mt-6">
                <div class="flex justify-between items-center text-xl font-semibold">
                    <span>Total:</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                <div class="mt-4 flex justify-end">
                    <a href="checkout"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                        Proceed to Checkout
                    </a>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <a href="products" class="block mt-6 text-blue-700 font-semibold">← Continue Shopping</a>
</body>

</html>