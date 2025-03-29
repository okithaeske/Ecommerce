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

</head>

<body>

    <!-- Navbar -->
    <nav id="navbar"
        class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-8 fixed top-0 left-0 right-0 z-50 transition-transform transform">
        <div class="container mx-auto flex items-center justify-center relative ">
            <!-- Logo in Center -->
            <a href="../view/index.php"
                class="text-white text-3xl font-bold absolute left-1/2 transform -translate-x-1/2">
                ZENTARA
            </a>

            <!-- Hamburger Menu on Right -->
            <button id="hamburger-icon" class="text-white text-2xl absolute right-0">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="fixed right-0 top-0 h-full w-64 bg-gray-900 text-white transform translate-x-full transition-transform duration-500 z-100">
            <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
            <div class="flex flex-col items-center mt-16 space-y-6 h-screen bg-gray-900 bg-opacity-60 p-8">
                <a href="../view/index.php" class="hover:text-gray-400 text-xl ">Home</a>
                <a href="../view/about.php" class="hover:text-gray-400 text-xl">About</a>
                <!-- Products with dropdown -->
                <div class="relative w-full flex flex-col items-center">
                    <button id="products-dropdown"
                        class="hover:text-gray-400 text-xl flex items-center justify-center w-full">
                        Our Products
                        <i id="dropdown-icon"
                            class="fas fa-chevron-down ml-2 text-sm transition-transform duration-300"></i>
                    </button>
                    <div id="product-categories" class="flex flex-col items-center mt-2 space-y-3 w-full hidden">
                        <a href="../view/product.php?category=old" class="hover:text-gray-400 text-lg">Old</a>
                        <a href="../view/product.php?category=lux" class="hover:text-gray-400 text-lg">Lux</a>
                        <a href="../view/product.php?category=modern" class="hover:text-gray-400 text-lg">Modern</a>
                        <a href="../admin/add.php?category=add" class="hover:text-gray-400 text-lg">Add Items</a>
                        <a href="../admin/delete.php?category=delete" class="hover:text-gray-400 text-lg">Delete Items</a>
                    </div>
                </div>
                <a href="../view/contact.php" class="hover:text-gray-400 text-xl">Contact</a>
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