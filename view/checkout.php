<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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

    <div class="text-center mt-4">
        <a href="cart" class="text-blue-600 text-lg font-semibold hover:underline">← Back to Cart</a>
    </div>

</body>

</html>