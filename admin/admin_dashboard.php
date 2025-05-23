<?php
session_start();
include 'config/db.php';

// Delete logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $deleteId = intval($_POST['delete_user_id']);
    $conn->query("DELETE FROM user WHERE user_id = $deleteId");
}

// Delete product logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
    $deleteProductId = intval($_POST['delete_product_id']);
    $conn->query("DELETE FROM product WHERE product_id = $deleteProductId");
}


// Total users
$result = $conn->query("SELECT COUNT(*) as total FROM user");
$totalUsers = $result->fetch_assoc()['total'];

// Full user list
$userList = $conn->query("SELECT user_id, name, email, role FROM user");

// Full product list
$productList = $conn->query("SELECT product_id, seller_id, name, price, category_name, image, description, created_at FROM product");


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome for the logout icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 font-bold text-xl border-b">Admin Panel</div>
            <nav class="p-4 space-y-2">
                <a href="#" onclick="showSection('dashboard')"
                    class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
                <a href="#" onclick="showSection('users')" class="block px-4 py-2 rounded hover:bg-gray-200">Users</a>
                <a href="#" onclick="showSection('products')"
                    class="block px-4 py-2 rounded hover:bg-gray-200">Products</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Orders</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Reports</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <div class="text-xl font-semibold">Dashboard</div>

                <!-- Logout Button -->
                <form action="logout" method="post" class="flex items-center">
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded flex items-center hover:bg-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>

            </header>

            <main class="p-6">
                <!-- Dashboard View -->
                <div id="dashboard-view" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Total Users</h3>
                        <p class="text-2xl font-bold mt-2"><?php echo number_format($totalUsers); ?></p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Total Orders</h3>
                        <p class="text-2xl font-bold mt-2">860</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Revenue</h3>
                        <p class="text-2xl font-bold mt-2">$12,450</p>
                    </div>
                </div>

                <!-- Users View (Initially Hidden) -->
                <div id="users-view" class="hidden mt-6">
                    <h1 class="text-2xl font-bold mb-4">All Users</h1>
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="py-2 px-4">ID</th>
                                <th class="py-2 px-4">Username</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $userList->fetch_assoc()): ?>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="py-2 px-4"><?= $row['user_id'] ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['role']) ?></td>
                                    <td class="py-2 px-4">
                                        <?php if ($row['role'] !== 'admin'): ?>
                                            <form method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <input type="hidden" name="delete_user_id" value="<?= $row['user_id'] ?>">
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-500">Admin</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Products View (Initially Hidden) -->
                <div id="products-view" class="hidden mt-6">
                    <h1 class="text-2xl font-bold mb-4">All Products</h1>
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="py-2 px-4">ID</th>
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4">Price</th>
                                <th class="py-2 px-4">Category</th>
                                <th class="py-2 px-4">Image</th>
                                <th class="py-2 px-4">Description</th>
                                <th class="py-2 px-4">Created At</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $productList->fetch_assoc()): ?>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="py-2 px-4"><?= $row['product_id'] ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="py-2 px-4">$<?= number_format($row['price'], 2) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['category_name']) ?></td>
                                    <td class="py-2 px-4">
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>"
                                            alt="<?= htmlspecialchars($row['name']) ?>" class="w-16 h-16 object-cover">
                                    </td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($row['description']) ?></td>
                                    <td class="py-2 px-4"><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                                    <td class="py-2 px-4">

                                        <form method="post" class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            <input type="hidden" name="delete_product_id" value="<?= $row['product_id'] ?>">
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </main>

        </div>
    </div>

</body>

<script>
    function showSection(section) {
        const dashboard = document.getElementById('dashboard-view');
        const users = document.getElementById('users-view');
        const products = document.getElementById('products-view');

        if (section === 'dashboard') {
            dashboard.classList.remove('hidden');
            users.classList.add('hidden');
            products.classList.add('hidden');
        } else if (section === 'users') {
            dashboard.classList.add('hidden');
            users.classList.remove('hidden');
            products.classList.add('hidden');
        } else if (section === 'products') {
            dashboard.classList.add('hidden');
            users.classList.add('hidden');
            products.classList.remove('hidden');
        }
    }
</script>


</html>