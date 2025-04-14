<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Select Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 h-screen flex items-center justify-center">

    <div class="bg-gray-800 p-10 rounded-2xl shadow-2xl max-w-md text-center space-y-6">
        <h1 class="text-white text-3xl font-bold mb-4">Choose Your Role</h1>

        <div class="flex flex-col space-y-4">
            <a href="register.php?role=user"
                class="bg-blue-500 hover:bg-blue-600 text-white py-4 px-6 rounded-xl text-xl flex items-center justify-center space-x-3 transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-user"></i>
                <span>Register as User</span>
            </a>

            <a href="register.php?role=seller"
                class="bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-xl text-xl flex items-center justify-center space-x-3 transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-store"></i>
                <span>Register as Seller</span>
            </a>
        </div>
    </div>

</body>

</html>