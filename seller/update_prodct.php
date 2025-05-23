

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>
        <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md grid gap-4">
            <input type="text" name="name" value="<?= htmlspecialchars($product['Name']) ?>" required
                class="p-2 border rounded" placeholder="Product Name">
            <input type="text" name="category" value="<?= htmlspecialchars($product['Category_name']) ?>" required
                class="p-2 border rounded" placeholder="Category">
            <input type="number" name="price" step="0.01" value="<?= $product['Price'] ?>" required
                class="p-2 border rounded" placeholder="Price">
            <textarea name="description" required
                class="p-2 border rounded"><?= htmlspecialchars($product['Description']) ?></textarea>

            <label class="block text-sm text-gray-600">Replace Image (optional):</label>
            <input type="file" name="image" accept="image/*" class="p-2 border rounded">

            <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>"
                class="w-48 h-32 object-cover mt-2 rounded shadow">

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update
                Product</button>
            <a href="seller\dashboard.php" class="text-blue-500 underline mt-2">← Back to Dashboard</a>
        </form>
    </div>
</body>

</html>