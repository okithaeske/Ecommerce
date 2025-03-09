<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- css -->
    <script src="../assets/tailwind.css"></script>
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <nav id="navbar" class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-8 fixed top-0 left-0 right-0 z-50 transition-transform transform">
        <div class="container mx-auto flex items-center justify-center relative ">
            <!-- Logo in Center -->
            <a href="../api/index.php" class="text-white text-3xl font-bold absolute left-1/2 transform -translate-x-1/2">
                ZENTARA
            </a>

            <!-- Hamburger Menu on Right -->
            <button id="hamburger-icon" class="text-white text-2xl absolute right-0">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        <!-- Mobile Menu (Hidden & Unique Animation) -->
        <div id="mobile-menu" class="fixed right-0 top-0 h-full w-64 bg-gray-900 text-white transform translate-x-full transition-transform duration-500 z-100">
            <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
            <div class="flex flex-col items-center mt-16 space-y-6 h-screen bg-gray-900 bg-opacity-60 p-8">
                <a href="../api/index.php" class="hover:text-gray-400 text-xl ">Home</a>
                <a href="../api/about.php" class="hover:text-gray-400 text-xl">About</a>
                <a href="../api/product.php" class="hover:text-gray-400 text-xl">Our Products</a>
                <a href="../api/contact.php" class="hover:text-gray-400 text-xl">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Script for Slide-in Animation -->
    <script>
        const hamburgerIcon = document.getElementById("hamburger-icon");
        const mobileMenu = document.getElementById("mobile-menu");
        const closeMenu = document.getElementById("close-menu");

        hamburgerIcon.addEventListener("click", () => {
            mobileMenu.classList.remove("translate-x-full");
            document.body.classList.add("overflow-hidden"); // Disable scrolling
        });

        closeMenu.addEventListener("click", () => {
            mobileMenu.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden"); // Enable scrolling
            
        });
    </script>



    <script>
        let lastScrollTop = 0; // Keep track of last scroll position
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scroll Down - Hide Navbar
                navbar.style.transform = "translateY(-100%)";
            } else {
                // Scroll Up - Show Navbar
                navbar.style.transform = "translateY(0)";
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative scroll
        });
    </script>


</body>

</html>