<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- css -->
    <script src="../assets/tailwind.css"></script>
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>

<body>

    <!-- Navbar -->
    <nav id="navbar"
        class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-8 fixed top-0 left-0 right-0 z-50 transition-transform transform">
        <div class="container mx-auto flex items-center justify-center relative ">

            <!-- Profile Icon on Left -->
            <?php if (isset($_SESSION['name'])): ?>
                <a href="profile" class="text-white text-2xl absolute left-0 hover:text-gray-400">
                    <i class="fas fa-user-circle"></i>
                    <span class="text-sm"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </a>
            <?php else: ?>
                <a href="login" class="text-white text-2xl absolute left-0 hover:text-gray-400">
                    <i class="fas fa-user-circle"></i>
                    <span class="text-sm">Login</span>
                </a>
            <?php endif; ?>

            <!-- Logo in Center -->
            <a href="home" class="text-white text-3xl font-bold absolute bg-center">
                ZENTARA
            </a>

            <!-- Hamburger Menu on Right -->
            <button id="hamburger-icon" class="text-white text-2xl absolute right-0">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        <div id="mobile-menu"
            class="fixed right-0 top-0 h-full w-64 bg-gray-900 text-white transform translate-x-full transition-transform duration-500 z-100">

            <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">&times;</button>

            <div class="flex flex-col items-center mt-16 space-y-6 h-screen bg-gray-900 bg-opacity-60 p-8">

                <a href="home" class="hover:text-gray-400 text-xl text-center w-full">Home</a>
                <a href="about" class="hover:text-gray-400 text-xl text-center w-full">About</a>
                <a href="products" class="hover:text-gray-400 text-xl text-center w-full">Products</a>
                <a href="dashboard" class="hover:text-gray-400 text-xl text-center w-full">Dashboard</a>
                <a href="contact" class="hover:text-gray-400 text-xl text-center w-full">Contact</a>
            </div>
        </div>


    </nav>

    <!-- Slide-in Animation -->
    <script>
        const hamburgerIcon = document.getElementById("hamburger-icon");
        const mobileMenu = document.getElementById("mobile-menu");
        const closeMenu = document.getElementById("close-menu");
        const productsDropdown = document.getElementById("products-dropdown");
        const productCategories = document.getElementById("product-categories");
        const dropdownIcon = document.getElementById("dropdown-icon");

        hamburgerIcon.addEventListener("click", () => {
            mobileMenu.classList.remove("translate-x-full");
            document.body.classList.add("overflow-hidden");
        });

        closeMenu.addEventListener("click", () => {
            mobileMenu.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
        });

        productsDropdown.addEventListener("click", () => {
            productCategories.classList.toggle("hidden");
            dropdownIcon.classList.toggle("rotate-180");
        });
    </script>

    <!-- Scroll bar -->
    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", function () {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {

                navbar.style.transform = "translateY(-100%)";
            } else {

                navbar.style.transform = "translateY(0)";
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });
    </script>



</body>

</html>