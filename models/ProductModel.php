<?php

class ProductModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Fetch all products
    public function getAllProducts() {
        $sql = "SELECT product_id, Name, Category_name, Price, Description, Image FROM product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch single product by ID
    public function getProductById($productId) {
        $sql = "SELECT product_id, Name, Price, Image FROM product WHERE product_id = :productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch multiple products by an array of IDs (for checkout)
    public function getProductsByIds(array $ids) {
        if (empty($ids)) return [];

        // Build placeholders like (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT product_id, Name, Price FROM product WHERE product_id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        // Bind values to placeholders
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, (int)$id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     // Get full list of products
    public function getProducts() {
        return $this->conn->query("SELECT product_id, seller_id, name, price, category_name, image, description, created_at FROM product");
    }

    // Delete product
    public function deleteProduct($productId) {
        $this->conn->query("DELETE FROM product WHERE product_id = $productId");
    }

 
}
?>
