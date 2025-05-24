<?php

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Fetch all products
    public function getAllProducts()
    {
        $sql = "SELECT product_id, Name, Category_name, Price, Description, Image FROM product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch single product by ID
    public function getProductById($productId)
    {
        $sql = "SELECT Product_ID,Seller_ID,Category_name, Name, Price, Image, Description FROM product WHERE Product_ID = :productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Add new product
    public function addProduct($sellerId, $name, $category, $price, $description, $imageData = null)
    {
        try {
            $sql = "INSERT INTO product (Seller_ID, Name, Category_name, Price, Description, Image) 
                VALUES (:sellerId, :name, :category, :price, :description, :image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':sellerId', $sellerId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);

            if ($imageData) {
                $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
            } else {
                $stmt->bindValue(':image', null, PDO::PARAM_NULL);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log the error or handle as necessary
            return false;
        }
    }


    public function updateProduct($productId, $sellerId, $name, $category, $price, $description, $imageData)
    {
        // SQL query to update product details
        $sql = "UPDATE product 
            SET Name = :name, 
                Category_name = :category, 
                Price = :price, 
                Description = :description, 
                Image = :image 
            WHERE Product_ID = :product_id 
            AND Seller_ID = :seller_id";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the prepared statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);

        // Bind the image as a BLOB
        if ($imageData !== null) {
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB); // Store image as binary (BLOB)
        } else {
            // If no new image is uploaded, pass NULL to the image parameter
            $stmt->bindValue(':image', null, PDO::PARAM_NULL);
        }

        // Bind product ID and seller ID to make sure we are updating the correct product for the correct seller
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':seller_id', $sellerId);

        // Execute the query and return whether it was successful or not
        return $stmt->execute();
    }


    // Get product by seller ID
    public function getProductsBySeller($sellerId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE Seller_ID = ?");
        $stmt->execute([$sellerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Fetch multiple products by an array of IDs (for checkout)
    public function getProductsByIds(array $ids)
    {
        if (empty($ids))
            return [];

        // Build placeholders like (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT product_id, Name, Price FROM product WHERE product_id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        // Bind values to placeholders
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, (int) $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get full list of products
    public function getProducts()
    {
        return $this->conn->query("SELECT product_id, seller_id, name, price, category_name, image, description, created_at FROM product");
    }

    // Delete product
    public function deleteProduct($productId)
    {
        $this->conn->query("DELETE FROM product WHERE product_id = $productId");
    }


}
?>