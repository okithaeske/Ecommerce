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

        include 'views/seller/add_product.php'; // Form view for adding product
    }

    // Handle deleting a product
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
            $sellerId = $_SESSION['user_id'];
            $this->productModel->deleteProduct($productId, $sellerId);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && !isset($_POST['name'])) {
            $_SESSION['edit_product_id'] = intval($_POST['product_id']);
            header("Location: update");
            exit();
        }

        $productId = $_SESSION['edit_product_id'] ?? 0;
        $product = $this->productModel->getProductBySeller($productId, $sellerId);

        if (!$product) {
            echo "Product not found or access denied.";
            exit();
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $imageData = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
            }

            $this->productModel->updateProduct($productId, $sellerId, $name, $category, $price, $description, $imageData);
            unset($_SESSION['edit_product_id']);
            header("Location: dashboard");
            exit();
        }

        include 'seller\update.php'; // Path to your update product form
    }

}
