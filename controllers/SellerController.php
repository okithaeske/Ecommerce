<?php

require_once 'models/ProductModel.php'; // Adjust path as needed


class SellerController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();

    }

    // Display seller dashboard with products
    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login");
            exit;
        }

        $sellerId = $_SESSION['user_id'];
        $products = $this->productModel->getProductsBySeller($sellerId);

        include 'seller\dashboard.php'; // Adjust view path as needed
    }

    // Handle adding a product
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sellerId = $_SESSION['user_id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $imageData = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
            }

            $this->productModel->addProduct($sellerId, $name, $category, $price, $description, $imageData);

            header("Location: seller\dashboard.php");
            exit;
        }

    }

    // Handle deleting a product
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
            $sellerId = $_SESSION['user_id'];
            $this->productModel->deleteProduct($productId);
        }

        header("Location: seller\dashboard.php");
        exit;
    }

    public function update()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
            header("Location: login");
            exit();
        }

        $sellerId = $_SESSION['user_id'];

        // Get the product ID from POST data
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
        } else {
            echo "Product not found or access denied.";
            exit();
        }

        // Fetch the product details
        $product = $this->productModel->getProductById($productId);

        // Check if the product belongs to the seller
        if (!$product || $product['Product_ID'] != $productId || $product['Seller_ID'] != $sellerId) {
            echo "Product not found or access denied.";
            exit();
        }

        // Handle form submission for updating product details
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $imageData = null;

            // Check if a new image is uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
            }

            // Update the product in the database
            $updateResult = $this->productModel->updateProduct($productId, $sellerId, $name, $category, $price, $description, $imageData);

            if ($updateResult) {
                // Redirect back to dashboard after successful update
                header("Location: dashboard");
                exit();
            } else {
                echo "Error: Unable to update product.";
            }
        }

        // Include the update page view with the product data
        include 'seller/update.php'; // Assuming this is the view path
    }




}
