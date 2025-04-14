<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- css -->
    <script src="../assets/tailwind.css"></script>
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- <?php include '../components/header.php'; ?> -->

    <div class="container mx-auto pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-6">
                <h1 class="text-2xl font-bold">Delete Product</h1>
                <p class="text-gray-300 mt-1">Enter Specific Product ID</p>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <!-- Product Name -->
                <div>
                    <label for="product_ID" class="block text-gray-700 font-medium mb-2">Product ID</label>
                    <input type="text" id="product_name" name="id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600">
                </div>


                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                        Delete Product
                    </button>
                </div>
            </form>
        </div>
    </div>



</body>

</html>