<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <script src="../assets/tailwind.css"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-4 shadow-lg shadow-gray-500/50">
        <div class="container mx-auto flex items-center justify-between sticky top-0">
            <!-- Logo -->
            <a href="../api/index.php" class="text-white text-2xl font-semibold">ZENTARA</a>

            <!-- Navbar Links for Desktop -->
            <div class="hidden md:flex space-x-6">
                <a href="../api/index.php" class="text-white hover:text-gray-400">Home</a>
                <a href="../api/about.php" class="text-white hover:text-gray-400">About</a>
                <a href="../api/product.php" class="text-white hover:text-gray-400">Our Products</a>
                <a href="../api/contact.php" class="text-white hover:text-gray-400">Contact</a>
            </div>

            <!-- Hamburger Icon for Mobile -->
            <div class="md:hidden">
                <button class="text-white" id="hamburger-icon">
                    <i class="fas fa-bars h-6 w-6"></i>
                </button>

            </div>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div class="md:hidden hidden" id="mobile-menu">
            <a href="../api/index.php" class="text-white hover:text-gray-400">Home</a>
            <a href="../api/about.php" class="text-white hover:text-gray-400">About</a>
            <a href="../api/product.php" class="text-white hover:text-gray-400">Our Products</a>
            <a href="../api/contact.php" class="text-white hover:text-gray-400">Contact</a>
        </div>
    </nav>

    <!-- Script to Toggle Mobile Menu -->
    <script>
        const hamburgerIcon = document.getElementById("hamburger-icon");
        const mobileMenu = document.getElementById("mobile-menu");

        hamburgerIcon.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>
</body>

</html>