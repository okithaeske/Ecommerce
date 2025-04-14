<?php
// Example: Connect to DB
// include '../config/db.php';

// // Get product ID
// $product_id = $_GET['id'] ?? null;
// if (!$product_id) {
//     echo "Product ID missing!";
//     exit;
// }

// // Fetch product from database (dummy data here)
// $product = [
//     'id' => $product_id,
//     'name' => 'Sample Product',
//     'description' => 'This is a sample product.',
//     'category' => 'modern',
//     'price' => 49.99,
//     'image' => '../uploads/sample.jpg'
// ];
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- <?php include '../components/header.php'; ?> -->

    <div class="container mx-auto pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-6">
                <h1 class="text-2xl font-bold">Update Product</h1>
                <p class="text-gray-300 mt-1">Modify the fields below to update your product</p>
            </div>

            <form action="updateproducthandler.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-600">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-600"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-600">
                        <option value="">Select Category</option>
                        <option value="old" <?= $product['category'] == 'old' ? 'selected' : '' ?>>Old</option>
                        <option value="lux" <?= $product['category'] == 'lux' ? 'selected' : '' ?>>Lux</option>
                        <option value="modern" <?= $product['category'] == 'modern' ? 'selected' : '' ?>>Modern</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-600">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Product Image</label>
                    <img src="<?= $product['image'] ?>" alt="Current Image" class="h-32 mb-2">
                    <input type="file" name="image" accept="image/*" class="w-full">
                    <p class="text-sm text-gray-500 mt-1">Upload only if you want to change the image.</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
