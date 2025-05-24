<?php
require_once 'config/db.php';

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function emailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT user_id FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function register($name, $email, $hashedPassword, $role)
    {
        $stmt = $this->conn->prepare("INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$name, $email, $hashedPassword, $role]);
        return $success ? $this->conn->lastInsertId() : false;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT user_id, name, role, password FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get total number of users
    public function getTotalUsers()
    {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM user");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Get full list of users
    public function getUsers()
    {
        return $this->conn->query("SELECT * FROM user");
    }

    public function deleteUser($deleteId)
    {
        $this->conn->beginTransaction();

        try {
            // Get user role
            $stmt = $this->conn->prepare("SELECT role FROM user WHERE user_id = ?");
            $stmt->execute([$deleteId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception("User not found");
            }

            if ($user['role'] === 'seller') {
                // Delete products by seller
                $stmt = $this->conn->prepare("DELETE FROM product WHERE Seller_ID = ?");
                $stmt->execute([$deleteId]);

                // Delete from sellers table
                $stmt = $this->conn->prepare("DELETE FROM sellers WHERE user_id = ?");
                $stmt->execute([$deleteId]);
            }

            // Delete order_items first
            $stmt = $this->conn->prepare("DELETE FROM order_items WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = ?)");
            $stmt->execute([$deleteId]);

            // Delete orders
            $stmt = $this->conn->prepare("DELETE FROM orders WHERE user_id = ?");
            $stmt->execute([$deleteId]);

            // Finally, delete the user
            $stmt = $this->conn->prepare("DELETE FROM user WHERE user_id = ?");
            $stmt->execute([$deleteId]);

            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }





    public function isDuplicate($store_name, $phone_number)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sellers WHERE store_name = ? AND phone_number = ?");
        $stmt->execute([$store_name, $phone_number]);
        return $stmt->rowCount() > 0;
    }

    public function registerstore($store_name, $logo_content, $phone_number, $user_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO sellers (store_name, store_logo, phone_number, user_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$store_name, $logo_content, $phone_number, $user_id]);
    }


}
