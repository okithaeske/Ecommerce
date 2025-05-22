<?php
session_start();
// Database connection
include 'config/db.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}
// Fetch All Products
$result = $conn->query("SELECT product_id, Name, Category_name, Price, Description, Image FROM product");
$products = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Watches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-black text-gray-800">

    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <section class="pt-16">
        <section class="bg-black w-screen overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 w-full">

                <!-- Main Banner -->
                <div class="lg:col-span-2 relative h-[32rem] rounded-none overflow-hidden shadow-none">
                    <img src="assets/images/productsbig.jpg" alt="Zenith Watch"
                        class="w-full h-[32rem] object-cover absolute inset-0 z-0">
                    <div class="relative z-10 p-8 bg-gradient-to-r from-white/80">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">ZENITH</h2>
                        <p class="uppercase text-sm text-white tracking-wide">Men's Collection</p>
                        <p class="mt-2 text-white text-sm max-w-xl">
                            Nullam risus tristique ultrice dapibus. Explore the bold look of our futuristic analog
                            iconic
                            craftsmanship collections.
                        </p>
                        <a href="#"
                            class="mt-2 inline-block px-3 py-1 text-sm bg-white text-black rounded hover:bg-gray-200">Shop
                            Now</a>
                    </div>
                </div>

                <!-- Side Banners -->
                <div class="flex flex-col">
                    <!-- Omega -->
                    <div class="relative h-[16rem] overflow-hidden group">
                        <img src="assets/images/productsSmall.jpg" alt="Omega"
                            class="w-full h-full object-cover group-hover:scale-105 transition">
                        <div
                            class="absolute inset-0 bg-black/30 flex flex-col justify-center items-start p-4 text-white">
                            <h3 class="text-lg font-semibold">OMEGA</h3>
                            <p class="text-xs">Seamaster Planet Ocean</p>
                            <a href="#"
                                class="mt-2 inline-block px-3 py-1 text-sm bg-white text-black rounded hover:bg-gray-200">Shop
                                Now</a>
                        </div>
                    </div>

                    <!-- Casio -->
                    <div class="relative h-[16rem] overflow-hidden group">
                        <img src="assets/images/productsSmall2.jpg" alt="Casio"
                            class="w-full h-full object-cover group-hover:scale-105 transition">
                        <div
                            class="absolute inset-0 bg-black/30 flex flex-col justify-center items-start p-4 text-white">
                            <h3 class="text-lg font-semibold">CASIO</h3>
                            <p class="text-xs">G-Shock</p>
                            <a href="#"
                                class="mt-2 inline-block px-3 py-1 text-sm bg-white text-black rounded hover:bg-gray-200">Shop
                                Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <section class="w-screen mb-7 mx-auto px-4 py-12 bg-[#F9FAFB]">
            <?php
            $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
            ?>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold border-b pb-2 text-gray-900">OUR PRODUCTS</h2>
                <a href="cart" class="text-sm bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                    🛒 Cart (<?= $cartCount ?>)
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition-all relative group">

                        <!-- Product Image -->
                        <div class="p-4 h-48 flex justify-center items-center bg-white">
                            <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>"
                                alt="<?= htmlspecialchars($product['Name']) ?>"
                                class="max-h-40 object-contain transition-transform duration-300 group-hover:scale-105">
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 text-center">
                            <h3 class="text-sm font-semibold text-gray-800 mb-1 truncate">
                                <?= htmlspecialchars($product['Name']) ?>
                            </h3>
                            <div class="text-sm">
                                <!-- <span
                                    class="text-gray-400 line-through mr-1">$<?= number_format($product['Price'] * 1.15, 2) ?></span> -->
                                <span class="text-black font-bold">$<?= number_format($product['Price'], 2) ?></span>
                            </div>

                            <!-- Add to Cart Button -->
                            <form action="add_to_cart" method="POST" class="mt-3">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <button type="submit" name="add_to_cart"
                                    class="mt-2 w-full bg-black text-white py-1.5 text-sm rounded hover:bg-gray-800 transition">
                                    Add to Cart 🛒
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php include 'components/footer.php'; ?>

</body>

</html>