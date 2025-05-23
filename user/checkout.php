<?php
session_start();
include 'config/db.php';

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

$products = [];
$total = 0;

$ids = implode(",", array_map('intval', array_keys($cart)));
$result = $conn->query("SELECT product_id, Name, Price FROM product WHERE product_id IN ($ids)");
while ($row = $result->fetch_assoc()) {
    $row['quantity'] = $cart[$row['product_id']];
    $row['subtotal'] = $row['Price'] * $row['quantity'];
    $total += $row['subtotal'];
    $products[] = $row;
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, fullname, email, address, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssd", $user_id, $fullname, $email, $address, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert each item into order_items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($products as $item) {
        $pid = $item['product_id'];
        $qty = $item['quantity'];
        $price = $item['Price'];
        $stmt->bind_param("iiid", $order_id, $pid, $qty, $price);
        $stmt->execute();
    }
    $stmt->close();

    // Clear cart and redirect
    $_SESSION['cart'] = [];
    header("Location: thankyou");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-4">Checkout</h1>

    <!-- Order Summary -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-3">Order Summary</h2>
        <ul class="space-y-2">
            <?php foreach ($products as $item): ?>
                <li class="flex justify-between text-gray-700">
                    <span><?= htmlspecialchars($item['Name']) ?> × <?= $item['quantity'] ?></span>
                    <span>$<?= number_format($item['subtotal'], 2) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr class="my-3">
        <div class="flex justify-between font-bold text-lg">
            <span>Total:</span>
            <span>$<?= number_format($total, 2) ?></span>
        </div>
    </div>

    <!-- Billing Info Form -->
    <form method="POST" class="bg-white p-6 rounded shadow space-y-4">
        <h2 class="text-xl font-semibold">Billing Information</h2>

        <div>
            <label class="block text-gray-600">Full Name</label>
            <input type="text" name="fullname" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-600">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-600">Address</label>
            <textarea name="address" class="w-full border px-3 py-2 rounded" rows="3" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
            Place Order
        </button>
    </form>

</body>

</html>