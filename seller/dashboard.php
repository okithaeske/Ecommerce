<?php
session_start();

// Check login and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$seller_id = $_SESSION['user_id'];

// Add product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO product (Seller_ID, Category_name, Name, Price, Image, Description) VALUES (?, ?, ?, ?, ?, ?)");
        $null = NULL;
        $stmt->bind_param("issdbs", $seller_id, $category, $name, $price, $null, $description);
        $stmt->send_long_data(4, $imageData);
        $stmt->execute();
        $stmt->close();
    }
}

// Delete product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
    $pid = intval($_POST['delete_product_id']);
    $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ? AND Seller_ID = ?");
    $stmt->bind_param("ii", $pid, $seller_id);
    if ($stmt->execute()) {
        header("Location: index.php?page=dashboard&deleted=1");
        exit();
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch products
$stmt = $conn->prepare("SELECT product_id, Name, Category_name, Price, Description, Image FROM product WHERE Seller_ID = ?");
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

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
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <form action="update">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <button type="submit" class="text-blue-600 hover:underline font-medium">Edit</button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')"
                                class="inline">
                                <input type="hidden" name="delete_product_id" value="<?= $product['product_id'] ?>">
                                <button type="submit" class="text-red-600 hover:underline font-medium">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>