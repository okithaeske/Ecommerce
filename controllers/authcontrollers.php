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

    // Register Method
    public function register()
    {
        $message = "";

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];
            $role = $_POST['role'];

            // Check if passwords match
            if ($password !== $confirm) {
                $message = "Passwords do not match.";
            } else {
                $userModel = new User();
                $existingUser = $userModel->findByEmail($email);

                // Check if email already exists
                if ($existingUser) {
                    $message = "Email already exists.";
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    // Insert the new user into the database
                    $userModel->register($name, $email, $hashedPassword, $role);

                    // Redirect after successful registration
                    header("Location: login?message=Registration successful&type=success");
                    exit();
                }
            }
        }

        // Render the registration form with any messages
        require_once 'auth/register.php';
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
