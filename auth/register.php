<?php

$role = isset($_GET['role']) ? $_GET['role'] : 'user'; // Defaults to 'user' if not provided
$roleTitle = ucfirst($role); // Makes it "User" or "Seller"
?>

<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce"; // Change this to your actual DB name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request from register form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Password match check
    if ($password !== $confirm) {
        header("Location: register?role=$role&message=Passwords do not match&type=error");
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: register");
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $insert = $conn->prepare("INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $name, $email, $hashedPassword, $role);

    if ($insert->execute()) {
        $newUserId = $insert->insert_id; // Get the auto-generated user_id

        if ($role === 'seller') {
            session_start(); // Ensure this is at the top of your script
            // After successful registration and insertion into the database
            $_SESSION['user_id'] = $newUserId; // Replace with your actual user ID variable

            // Redirect to store_register with user_id
            header("Location: store_register?user_id=$newUserId&message=Registration successful&type=success");
            exit;
        } elseif ($role === 'user') {
            // Regular user, redirect to login
            header("Location: login?message=Registration successful&type=success");
            exit;
        }
    } else {
        header("Location: register?role=$role&message=Error registering user&type=error");
    }

    $insert->close();

}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register as <?= $roleTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body
    class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 text-white min-h-screen flex items-center justify-center">

    <div class="bg-gray-800 rounded-2xl shadow-xl p-10 w-full max-w-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Register</h2>
        <form action="register" method="POST" class="space-y-5">

            <div>
                <label for="name" class="block mb-1">User Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <span>Select Role:</span>
                <div class="flex items-center mb-4">
                    <span>User</span>
                    <input type="radio" name="role" id="role_user" value="user"
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span>Seller</span>
                    <input type="radio" name="role" id="role_seller" value="seller"
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>


            <div class="relative w-full">
                <label for="password" class="block">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Toggle Button -->
                <button type="button" id="togglePassword"
                    class="absolute top-9 right-3 text-gray-600 focus:outline-none">
                    👀
                </button>
            </div>

            <div class="relative w-full">
                <label for="confirm password" class="block">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Toggle Button -->
                <button type="button" id="toggleconfirmPassword"
                    class="absolute top-9 right-3 text-gray-600 focus:outline-none">
                    👀
                </button>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 py-3 rounded-xl text-white text-lg font-semibold transition duration-300">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-5">
            Already have an account?
            <a href="login" class="text-blue-400 hover:underline">Login here</a>
        </p>
    </div>

</body>

<script>
    const togglePassword = document.getElementById("togglePassword");
    const toggleconfirmPassword = document.getElementById("toggleconfirmPassword");
    const passwordField = document.getElementById("password");
    const confirmpasswordField = document.getElementById("confirm_password")

    togglePassword.addEventListener("click", () => {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Optional: Change icon/text
        togglePassword.textContent = type === "password" ? "👀" : "🙈";
    });

    toggleconfirmPassword.addEventListener("click", () => {
        const type = confirmpasswordField.getAttribute("type") === "password" ? "text" : "password";
        confirmpasswordField.setAttribute("type", type);

        // Optional: Change icon/text
        toggleconfirmPassword.textContent = type === "password" ? "👀" : "🙈";
    });


</script>

</html>