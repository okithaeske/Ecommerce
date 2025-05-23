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

    public function findByEmail($email)
    {
        $sql = "SELECT user_id, name, role, password FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Register a new user
    public function register($name, $email, $password, $role)
    {
        $sql = "INSERT INTO user (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":role", $role);

        return $stmt->execute();
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

    // Delete user and related products
    public function deleteUser($deleteId)
    {
        $this->conn->beginTransaction();

        try {
            // Get user role
            $userResult = $this->conn->query("SELECT role FROM user WHERE user_id = $deleteId");
            $user = $userResult->fetch(PDO::FETCH_ASSOC);

            if ($user['role'] === 'seller') {
                // Delete all products of the seller
                $this->conn->query("DELETE FROM product WHERE Seller_ID = $deleteId");
                $this->conn->query("DELETE FROM sellers WHERE user_id = $deleteId");
            }

            // Delete the user
            $this->conn->query("DELETE FROM user WHERE user_id = $deleteId");

            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }


    }


}
