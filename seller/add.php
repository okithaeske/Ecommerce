<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the user is a seller
if ($_SESSION['role'] == 'user') {
    header("Location: home");    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $seller_id = $_SESSION['user_id'];
    $category = $_POST['category'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0.0;
    $description = $_POST['description'] ?? '';

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES["image"]["tmp_name"];
        $imageData = file_get_contents($imageTmp);

        $stmt = $conn->prepare("INSERT INTO product (Seller_ID, Category_name, Name, Price, Image, Description) VALUES (?, ?, ?, ?, ?, ?)");
        $null = NULL;
        $stmt->bind_param("issdbs", $seller_id, $category, $name, $price, $null, $description);
        $stmt->send_long_data(4, $imageData);

        if ($stmt->execute()) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please upload a valid image.";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addproduct</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- css -->
    <script src="../assets/tailwind.css"></script>
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>

<body>
    <!-- <?php include '../components/header.php'; ?> -->

    <!-- Admin Product Form -->
    <div class="container mx-auto pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-6">
                <h1 class="text-2xl font-bold">Add New Product</h1>
                <p class="text-gray-300 mt-1">Enter product details to add to the database</p>
            </div>

            <form action="add" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                

                <!-- Product Name -->
                <div>
                    <label for="product_name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input type="text" id="product_name" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600">
                </div>

                <!-- Product Description -->
                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600"></textarea>
                </div>

                <!-- Product Category -->
                <div>
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select id="category" name="category" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600">
                        <option value="">Select Category</option>
                        <option value="old">Old</option>
                        <option value="lux">Lux</option>
                        <option value="modern">Modern</option>
                    </select>
                </div>

                <!-- Product Price -->
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600">
                </div>

                <!-- Product Image -->
                <div>
                    <label for="product_image" class="block text-gray-700 font-medium mb-2">Product Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl"></i>
                        </div>
                        <p class="text-gray-500 mb-2">Drag and drop your image here or</p>
                        <label for="product_image"
                            class="cursor-pointer bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Browse Files
                        </label>
                        <input type="file" id="product_image" name="image" accept="image/*" required class="hidden">
                        <p class="text-gray-400 mt-2 text-sm">Maximum file size: 5MB</p>
                        <div id="image-preview" class="mt-4 hidden">
                            <p class="text-sm text-gray-500">Selected image:</p>
                            <div class="w-32 h-32 mx-auto mt-2 bg-gray-100 flex items-center justify-center">
                                <img id="preview-img" src="#" alt="Preview" class="max-h-full max-w-full">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>