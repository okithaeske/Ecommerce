<?php
require_once 'models/ProductModel.php';

class ProductController {
    
    // This method will fetch and display all products
    public function show() {
        // Instantiate the ProductModel
        $productModel = new ProductModel();
        
        // Fetch all products
        $products = $productModel->getAllProducts();

        // Pass the products data to the view
        require_once 'view/product.php'; 
    }

    // You can add other methods like showProductDetails for individual product pages, etc.
}
