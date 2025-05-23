<?php
session_start(); // Ensure this is at the top of your script

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // echo "User ID: " . htmlspecialchars($userId); // Display the user ID for debugging
    // You can also use it in your SQL queries or other logic
    // Proceed with using $userId as needed
} else {
    // Handle the case where user_id is not set in the session
    echo "Invalid access. User ID not found.";
    exit;
}
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luxury_ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $store_name = trim($_POST['store_name']);
    $phone_number = trim($_POST['phone_number']);
    $logo = $_FILES['store_logo']['tmp_name'];
    $logo_type = mime_content_type($logo);

    // Validate image
    if (!file_exists($logo) || !$logo_type || strpos($logo_type, 'image/') !== 0) {
        $message = "Please upload a valid image file for the store logo.";
    } else {
        // Check for duplicate store name or phone number
        $checkStmt = $conn->prepare("SELECT * FROM sellers WHERE store_name = ? AND phone_number = ?");
        $checkStmt->bind_param("ss", $store_name, $phone_number);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Store name or phone number already exists.";
        } else {
            // All validations passed – proceed
            $logo_content = file_get_contents($logo);
            // Insert the store with the associated user_id
            $stmt = $conn->prepare("INSERT INTO sellers (store_name, store_logo, phone_number, user_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $store_name, $logo_content, $phone_number, $userId);

            if ($stmt->execute()) {
                $message = "Store registered successfully! Redirecting to login...";
                $success = true;
                header("location: login?message=Registration successful&type=success");
                exit;
            } else {
                $message = "Database error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Store Registration Form</h2>
        <!-- Error Message -->
        <?php if (!empty($message)): ?>
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 px-4 py-2 rounded">
                <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?> 

        <form action="store_register" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="store_name" class="block text-gray-600 font-medium">Store Name:</label>
                <input type="text" id="store_name" name="store_name" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="store_logo" class="block text-gray-600 font-medium">Store Logo:</label>
                <input type="file" id="store_logo" name="store_logo" accept="image/*" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-600 font-medium">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-center mt-6">
                <input type="submit" value="Register Store"
                    class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </form>
    </div>
</body>

</html>