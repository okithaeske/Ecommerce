<?php
require_once 'models/UserModel.php';

class AuthController
{
    // Login Method
    public function login()
    {

        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                $redirect = $user['role'] === 'admin' ? 'admin_dashboard' : 'home';
                $this->redirectTo($redirect);  // Calls the helper function for redirection
            } else {
                $message = "Invalid email or password.";
            }
        }

        require_once 'auth/login.php';
    }
    public function RegisterN()
    {
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? 'customer';

            $userModel = new User();

            if ($password !== $confirm) {
                $message = "Passwords do not match.";
            } elseif (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                $message = "Password must be at least 8 characters long and contain both letters and numbers.";
            } elseif ($userModel->emailExists($email)) {
                $message = "Email already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $userId = $userModel->register($name, $email, $hashedPassword, $role);

                if ($userId) {
                    if ($role === 'seller') {
                        $_SESSION['user_id'] = $userId;
                        $this->redirectTo("store_register?user_id=$userId");
                    } else {
                        $this->redirectTo("login");
                    }
                    return;
                } else {
                    $message = "Error registering user.";
                }
            }
        }

        require_once 'auth/register.php'; // Assuming this is your register view
    }

    public function Registerstore()
    {
        $message = "";

        if (!isset($_SESSION['user_id'])) {
            echo "Invalid access. User ID not found.";
            exit;
        }

        require_once 'models/UserModel.php';
        require_once 'config/db.php';

        $userId = $_SESSION['user_id'];
        $userModel = new User(); // uses db inside the constructor

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $store_name = trim($_POST['store_name']);
            $phone_number = trim($_POST['phone_number']);
            $logo = $_FILES['store_logo']['tmp_name'];
            $logo_type = mime_content_type($logo);

            if (!file_exists($logo) || !$logo_type || strpos($logo_type, 'image/') !== 0) {
                $message = "Please upload a valid image file for the store logo.";
            } elseif ($userModel->isDuplicate($store_name, $phone_number)) {
                $message = "Store name or phone number already exists.";
            } else {
                $logo_content = file_get_contents($logo);
                if ($userModel->registerstore($store_name, $logo_content, $phone_number, $userId)) {
                    header("Location: login?message=Store registered successfully&type=success");
                    exit;
                } else {
                    $message = "Database error. Please try again.";
                }
            }
        }

        require 'auth\store_register.php';
    }





    // Logout Method
    public function logout()
    {
        session_start();  // Start the session to access the session variables
        session_unset();  // Unset all session variables
        session_destroy();  // Destroy the session

        $this->redirectTo('login');
    }

    // Helper function for redirection
    private function redirectTo($page)
    {
        $baseUrl = dirname($_SERVER['SCRIPT_NAME']);  // E.g., /Ecommerce
        $baseUrl = rtrim($baseUrl, '/') . '/';  // Ensure a trailing slash

        header("Location: {$baseUrl}$page");
        exit();
    }
}
