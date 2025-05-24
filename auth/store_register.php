<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Store Registration Form</h2>
        <!-- Error Message -->
        <?php if (!empty($message)): ?>
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 px-4 py-2 rounded">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="storeRegister" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="store_name" class="block text-gray-600 font-medium">Store Name:</label>
                <input type="text" id="store_name" name="store_name" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="store_logo" class="block text-gray-600 font-medium">Store Logo:</label>
                <input type="file" id="store_logo" name="store_logo" accept="image/*" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-600 font-medium">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-center mt-6">
                <input type="submit" value="Register Store"
                    class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </form>
    </div>
</body>

</html>