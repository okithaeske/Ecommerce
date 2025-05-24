<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">

    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <div class="max-w-7xl mx-auto px-6 py-8 pt-20">
        <h1 class="text-4xl font-bold mb-6">Welcome, <span
                class="text-blue-700"><?= htmlspecialchars($_SESSION['name']) ?></span></h1>

        <!-- Add Product Form -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-10 border border-gray-200">
            <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>
            <form action="add" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="name" placeholder="Product Name" required
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="category" placeholder="Category" required
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" step="0.01" name="price" placeholder="Price" required
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="file" name="image" accept="image/*" required class="p-3 border border-gray-300 rounded-lg">
                <textarea name="description" placeholder="Description" required
                    class="col-span-1 md:col-span-2 p-3 border border-gray-300 rounded-lg h-28 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit" name="add"
                    class="col-span-1 md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">Add
                    Product</button>
            </form>
        </div>


        <!-- Product Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($products as $product): ?>
                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>" alt="Product Image"
                        class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold mb-1"><?= htmlspecialchars($product['Name']) ?></h3>
                        <p class="text-sm text-gray-500 mb-2"><?= htmlspecialchars($product['Category_name']) ?></p>
                        <p class="text-lg font-semibold text-green-600 mb-2">$<?= number_format($product['Price'], 2) ?></p>
                        <p class="text-sm text-gray-700 mb-4"><?= htmlspecialchars($product['Description']) ?></p>
                        <div class="flex justify-between items-center">
                            <form method="POST" action="update">
                                <input type="hidden" name="product_id" value="<?= $product['Product_ID'] ?>">
                                <button type="submit">Edit</button>
                            </form>
                            <form action="delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <input type="hidden" name="product_id" value="<?= $product['Product_ID'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>