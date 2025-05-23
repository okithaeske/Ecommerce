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

    <section class="pt-16">
        <section class="bg-black w-screen overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 w-full">

                <!-- Main Banner -->
                <div class="lg:col-span-2 relative h-[32rem] rounded-none overflow-hidden shadow-none">
                    <img src="assets/images/productsbig.jpg" alt="Zenith Watch"
                        class="w-full h-[32rem] object-cover absolute inset-0 z-0">
                    <div class="relative z-10 p-8 bg-gradient-to-r from-white/80">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">ROLEX</h2>
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
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller'): ?>
                    <a href="cart" class="text-sm bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                        🛒 Cart (<?= $cartCount ?>)
                    </a>
                <?php endif; ?>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition-all relative group">

                        <!-- Product Image -->
                        <div class="p-4 h-48 flex justify-center items-center bg-white">
                            <img src="data:image/jpeg;base64,<?= base64_encode($product['Image']) ?>"
                                alt="<?= htmlspecialchars($product['Name']) ?>"
                                class="max-h-40 object-contain transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                                onclick="openModal(  '<?= $product['product_id'] ?>',
        '<?= htmlspecialchars($product['Name']) ?>',
        '<?= htmlspecialchars($product['Category_name']) ?>',
        '<?= $product['Price'] ?>',
        `<?= htmlspecialchars($product['Description']) ?>`,
        '<?= base64_encode($product['Image']) ?>'
     )">

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
                            <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller'): ?>
                                <form action="add_to_cart" method="POST" class="mt-3">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <button type="submit" name="add_to_cart"
                                        class="mt-2 w-full bg-black text-white py-1.5 text-sm rounded hover:bg-gray-800 transition">
                                        Add to Cart 🛒
                                    </button>
                                </form>
                            <?php else: ?>
                                <div
                                    class="mt-3 w-full bg-gray-300 text-gray-500 py-1.5 text-sm rounded text-center cursor-not-allowed">
                                    Add to Cart Disabled
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php include 'components/footer.php'; ?>

        <!-- Product Modal -->
        <div id="productModal"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center">
            <div class="bg-white w-11/12 md:w-3/4 h-3/4 rounded-lg shadow-lg overflow-y-auto relative">
                <button onclick="closeModal()"
                    class="absolute top-3 right-3 bg-black text-white px-3 py-1 rounded hover:bg-gray-800">✖</button>
                <div class="grid md:grid-cols-2 gap-4 p-6">
                    <div class="flex justify-center items-center">
                        <img id="modalImage" src="" alt="Product" class="max-h-[400px] object-contain rounded">
                    </div>
                    <div>
                        <h2 id="modalName" class="text-2xl font-bold text-gray-900 mb-2"></h2>
                        <p id="modalCategory" class="text-sm text-gray-500 mb-4"></p>
                        <p id="modalPrice" class="text-xl font-semibold text-black mb-4"></p>
                        <p id="modalDescription" class="text-gray-700 mb-4"></p>
                        <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller'): ?>
                            <form action="add_to_cart" method="POST">
                                <input type="hidden" id="modalProductId" name="product_id" value="">
                                <button type="submit"
                                    class="mt-2 w-full bg-black text-white py-2 text-sm rounded hover:bg-gray-800 transition">
                                    Add to Cart 🛒
                                </button>
                            </form>
                        <?php else: ?>
                            <div
                                class="mt-2 w-full bg-gray-300 text-gray-500 py-2 text-sm rounded text-center cursor-not-allowed">
                                Add to Cart Disabled for Sellers
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function openModal(productId, name, category, price, description, imageBase64) {
                document.getElementById('modalProductId').value = productId;
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalCategory').innerText = category;
                document.getElementById('modalPrice').innerText = `$${parseFloat(price).toFixed(2)}`;
                document.getElementById('modalDescription').innerText = description;
                document.getElementById('modalImage').src = 'data:image/jpeg;base64,' + imageBase64;
                document.getElementById('productModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('productModal').classList.add('hidden');
            }
        </script>



</body>

</html>