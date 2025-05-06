<?php
// controller/AuthController.php
require_once '../model/user.php';
require_once '../config/db.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($email, $password);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php?page=home");
                exit();
            } else {
                $error = "Invalid email or password.";
                include 'view/login.php';
            }
        } else {
            include 'view/login.php';
        }
    }
}
