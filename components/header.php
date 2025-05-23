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
    <!-- Logout Modal -->
    <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
            <h2 class="text-xl font-semibold mb-4">Logout</h2>
            <p class="mb-6">Are you sure you want to logout?</p>
            <div class="flex justify-around">
                <form action="logout" method="POST">
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Yes, Logout</button>
                </form>
                <button id="cancelLogout"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav id="navbar"
        class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-8 fixed top-0 left-0 right-0 z-50 transition-transform transform">
        <div class="container mx-auto flex items-center justify-center relative ">

            <!-- Profile Icon on Left -->
            <?php if (isset($_SESSION['name'])): ?>
                <button id="profile-button"
                    class="text-white text-2xl absolute left-0 hover:text-gray-400 focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                    <span class="text-sm"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </button>
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
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'seller'): ?>
                    <a href="dashboard" class="hover:text-gray-400 text-xl text-center w-full">Dashboard</a>
                <?php endif; ?>
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

    <script>
        const profileBtn = document.getElementById('profile-button');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');

        if (profileBtn && logoutModal && cancelLogout) {
            profileBtn.addEventListener('click', () => {
                logoutModal.classList.remove('hidden');
            });

            cancelLogout.addEventListener('click', () => {
                logoutModal.classList.add('hidden');
            });

            // Optional: close modal if user clicks outside of it
            logoutModal.addEventListener('click', (e) => {
                if (e.target === logoutModal) {
                    logoutModal.classList.add('hidden');
                }
            });
        }
    </script>




</body>

</html>