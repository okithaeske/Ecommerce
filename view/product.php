<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "luxury_ecommerce";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

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
</head>

<body class="bg-black text-gray-800">

    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <section class="pt-6 pb-5">
        <section class="bg-black py-10 w-screen overflow-hidden">
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


        <!-- Featured Products -->
        <section class="max-w-7xl mx-auto px-4 py-12 bg-[#D7A9A9]">
            <h2 class="text-2xl font-bold mb-6 border-b pb-2 text-white">Featured Products</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition-all text-center p-4">
                        <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>"
                            alt="<?= htmlspecialchars($product['Name']) ?>" class="w-full h-40 object-contain mb-3">

                        <h3 class="text-sm font-medium text-gray-800 truncate"><?= htmlspecialchars($product['Name']) ?>
                        </h3>
                        <p class="text-sm text-black font-bold mt-1">$<?= number_format($product['Price'], 2) ?></p>

                        <form action="cart.php" method="POST" class="mt-3">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <button type="submit" name="add_to_cart"
                                class="mt-2 w-full bg-black text-white py-1 text-sm rounded hover:bg-gray-800">
                                Add to Cart 🛒
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- Footer -->
        <?php include 'components/footer.php'; ?>

</body>

</html>