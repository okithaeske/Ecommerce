<?php
class OrderModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function createOrder($userId, $fullname, $email, $address, $total) {
        $sql = "INSERT INTO orders (user_id, fullname, email, address, total) 
                VALUES (:user_id, :fullname, :email, :address, :total)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':fullname' => $fullname,
            ':email' => $email,
            ':address' => $address,
            ':total' => $total
        ]);

        return $this->conn->lastInsertId();
    }

    public function addOrderItems($orderId, $items) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);

        foreach ($items as $item) {
            $stmt->execute([
                ':order_id' => $orderId,
                ':product_id' => $item['product_id'],
                ':quantity' => $item['quantity'],
                ':price' => $item['Price']
            ]);
        }
    }

     // Get total orders
    public function getTotalOrders() {
        $result = $this->conn->query("SELECT COUNT(*) as total_orders FROM orders");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['total_orders'];
    }

    // Get total revenue
    public function getRevenue() {
        $result = $this->conn->query("SELECT SUM(total) AS total_amount FROM orders");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount'] * 0.01; // Assuming revenue is a percentage of total sales
    }

    // Get full list of orders
    public function getOrders() {
        return $this->conn->query("SELECT order_id, user_id, total, fullname, email, address, created_at FROM orders");
    }
}
