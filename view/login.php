<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

        <form action="login_process.php" method="POST" class="space-y-6">

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                    <input type="email" id="email" name="email" required class="w-full focus:outline-none text-gray-700"
                        placeholder="example@email.com">
                </div>
            </div>

            <!-- Password -->
            <div class="relative w-full">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Enter your password">

                <!-- Toggle Button -->
                <button type="button" id="togglePassword"
                    class="absolute top-9 right-3 text-gray-600 focus:outline-none">
                    👀
                </button>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-gray-800 text-white font-semibold py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </div>

            <!-- Link -->
            <p class="text-sm text-center text-gray-600 mt-4">
                Don’t have an account?
                <a href="roleselection.php" class="text-gray-800 font-semibold hover:underline">Sign up</a>
            </p>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Optional: Change icon/text
            togglePassword.textContent = type === "password" ? "👀" : "🙈";
        });
    </script>

</body>

</html>