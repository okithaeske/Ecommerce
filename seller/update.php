<?php
session_start();

// Check login and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
    header("Location: login");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$seller_id = $_SESSION['user_id'];

// Handle POST redirection from dashboard
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $_SESSION['edit_product_id'] = intval($_POST['product_id']);
    header("Location: update.php");
    exit();
}

// Load product_id from session
$product_id = isset($_SESSION['edit_product_id']) ? intval($_SESSION['edit_product_id']) : 0;

// Fetch product
$stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ? AND Seller_ID = ?");
$stmt->bind_param("ii", $product_id, $seller_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "Product not found or access denied.";
    exit();
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $stmt = $conn->prepare("UPDATE product SET Name=?, Category_name=?, Price=?, Description=?, Image=? WHERE product_id=? AND Seller_ID=?");
        $null = NULL;
        $stmt->bind_param("ssdssbi", $name, $category, $price, $description, $null, $product_id, $seller_id);
        $stmt->send_long_data(4, $imageData);
    } else {
        // Keep old image
        $stmt = $conn->prepare("UPDATE product SET Name=?, Category_name=?, Price=?, Description=? WHERE product_id=? AND Seller_ID=?");
        $stmt->bind_param("ssdssi", $name, $category, $price, $description, $product_id, $seller_id);
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();

    unset($_SESSION['edit_product_id']);
    header("Location: dashboard");
    exit();
}
?>

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
            <input type="text" name="name" value="<?= htmlspecialchars($product['Name']) ?>" required class="p-2 border rounded" placeholder="Product Name">
            <input type="text" name="category" value="<?= htmlspecialchars($product['Category_name']) ?>" required class="p-2 border rounded" placeholder="Category">
            <input type="number" name="price" step="0.01" value="<?= $product['Price'] ?>" required class="p-2 border rounded" placeholder="Price">
            <textarea name="description" required class="p-2 border rounded"><?= htmlspecialchars($product['Description']) ?></textarea>

            <label class="block text-sm text-gray-600">Replace Image (optional):</label>
            <input type="file" name="image" accept="image/*" class="p-2 border rounded">

            <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>" class="w-48 h-32 object-cover mt-2 rounded shadow">

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update Product</button>
            <a href="dashboard" class="text-blue-500 underline mt-2">← Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
