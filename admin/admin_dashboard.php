<!-- admin/admin_dashboard.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <a href="#" onclick="showSection('orders')" class="block px-4 py-2 rounded hover:bg-gray-200">Orders</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <div class="text-xl font-semibold">Dashboard</div>
                <form action="logout" method="post" class="flex items-center">
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded flex items-center hover:bg-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </header>

            <main class="p-6">
                <!-- Dashboard Stats -->
                <div id="dashboard-view" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Total Users</h3>
                        <p class="text-2xl font-bold mt-2"><?php echo number_format($totalUsers); ?></p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Total Orders</h3>
                        <p class="text-2xl font-bold mt-2"><?php echo number_format($totalOrders); ?></p>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <h3 class="text-gray-700">Revenue</h3>
                        <p class="text-2xl font-bold mt-2">$<?php echo number_format($revenue, 2); ?></p>
                    </div>
                </div>

                <!-- Users Section -->
                <div id="users-view" class="hidden mt-6">
                    <h2 class="text-xl font-semibold mb-4">User List</h2>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userList as $user): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $user['user_ID']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $user['Name']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $user['email']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $user['Role']; ?></td>
                                    <td class="border px-4 py-2">
                                        <?php if (strtolower($user['Role']) === 'admin'): ?>
                                            <span class="text-gray-500 italic">admin</span>
                                        <?php else: ?>
                                            <form action="admindelete" method="post" class="inline">
                                                <input type="hidden" name="delete_id" value="<?php echo $user['user_ID']; ?>">
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Products Section -->
                <div id="products-view" class="hidden mt-6">
                    <h2 class="text-xl font-semibold mb-4">Product List</h2>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Product ID</th>
                                <th class="border px-4 py-2">Image</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Price</th>
                                <th class="border px-4 py-2">Category</th>
                                <th class="border px-4 py-2">Description</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productList as $product): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $product['product_id']; ?></td>
                                    <td class="border px-4 py-2">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product['image']); ?>"
                                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                                            class="w-16 h-16 object-cover">
                                    </td>
                                    <td class="border px-4 py-2"><?php echo $product['name']; ?></td>
                                    <td class="border px-4 py-2">$<?php echo number_format($product['price'], 2); ?></td>
                                    <td class="border px-4 py-2"><?php echo $product['category_name']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $product['description']; ?></td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Orders Section -->
                <div id="orders-view" class="hidden mt-6">
                    <h2 class="text-xl font-semibold mb-4">Order List</h2>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Order ID</th>
                                <th class="border px-4 py-2">User ID</th>
                                <th class="border px-4 py-2">Full Name</th>
                                <th class="border px-4 py-2">Total Price</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderList as $order): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $order['order_id']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $order['user_id']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $order['fullname']; ?></td>
                                    <td class="border px-4 py-2">$<?php echo number_format($order['total'], 2); ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        function showSection(section) {
            const sections = ['dashboard-view', 'users-view', 'products-view', 'orders-view'];
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.classList.add('hidden');
            });
            const showEl = document.getElementById(`${section}-view`);
            if (showEl) showEl.classList.remove('hidden');
        }
    </script>
</body>

</html>