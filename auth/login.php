<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Default empty

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT user_id,name,role, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $name, $role, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;
           
            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin_dashboard");
            } else {
                header("Location: home");
            }
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "Email not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

        <!-- Error Message -->
        <?php if (!empty($message)): ?>
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 px-4 py-2 rounded">
                <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login" class="space-y-6">
            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-white">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                    <input type="email" id="email" name="email" required
                        class="w-full focus:outline-none text-gray-700 bg-transparent" placeholder="example@email.com">
                </div>
            </div>

            <!-- Password -->
            <div class="relative w-full">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Enter your password">
                <button type="button" id="togglePassword"
                    class="absolute top-9 right-3 text-gray-600 focus:outline-none text-lg">
                    👁️
                </button>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-gray-800 text-white font-semibold py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </div>

            <!-- Sign Up Link -->
            <p class="text-sm text-center text-gray-600 mt-4">
                Don’t have an account?
                <a href="register" class="text-gray-800 font-semibold hover:underline">Sign up</a>
            </p>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
            togglePassword.textContent = type === "password" ? "👀" : "🙈";
        });
    </script>

</body>

</html>