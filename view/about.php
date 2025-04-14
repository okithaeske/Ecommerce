<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="../assets/tailwind.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>

<body>
    <!-- navbar -->
    <!-- <?php include '../components/header.php'; ?> -->

    <!-- Brand Legacy Section -->
    <div class="parallax h-screen flex items-center justify-center text-center px-6">
        <video class="absolute top-0 left-0 w-full h-full object-cover" autoplay loop muted>
            <source src="assets/video/herovidABT.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white px-4">
            <h1 class="text-5xl md:text-7xl font-bold">A Legacy of Timeless Elegance</h1>
            <p class="text-gray-300 text-lg md:text-xl">
                Crafting timepieces with precision and artistry since 2025.
            </p>
        </div>
    </div>

    <!-- Craftsmanship Section -->
    <div class="relative bg-gray-900 py-20 px-6 md:px-16">
        <div class="container mx-auto flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 fade-in">
                <h1 class="text-4xl font-bold text-gold">The Art of Watchmaking</h1>
                <p class="text-gray-300 mt-4">Our master watchmakers blend the finest materials—diamond-cut sapphire
                    glass, aerospace-grade titanium, and Swiss automatic movements—to craft timeless pieces that
                    transcend generations.</p>
            </div>
            <div class="md:w-1/2 flex justify-center fade-in">
                <img src="assets/images/craftmanship.jpeg" alt="Time meets Art"
                    class="w-screen md:w-auto shadow-lg h-auto md:h-screen object-cover">
            </div>
        </div>
    </div>

    <!--  Lifestyle & Prestige Section -->
    <div class="parallax h-screen flex items-center justify-center text-center px-6"
        style="background-image: url('assets/images/lifestyle-bg.jpg');">
        <div class="fade-in">
            <h1 class="text-5xl font-bold text-gold">A Statement of Prestige</h1>
            <p class="text-gray-300 mt-4 text-lg">Worn by leaders, visionaries, and those who demand the extraordinary.
            </p>
        </div>
    </div>

    <!-- Future & Innovation Section -->
    <div class="bg-gray-800 py-20 px-6 md:px-16">
        <div class="container mx-auto text-center fade-in">
            <h1 class="text-4xl font-bold text-gold">The Future of Luxury</h1>
            <p class="text-gray-300 mt-4 text-lg">Sustainably crafted, technologically advanced, and artistically
                inspired. The next chapter begins soon…</p>
            <button
                class="mt-6 bg-gold text-black px-6 py-3 font-bold rounded-full shadow-lg hover:bg-yellow-500 transition">Explore
                More</button>
        </div>
    </div>


    <!-- Scroll indicator -->
    <div class="fixed right-5 top-1/2 transform -translate-y-1/2 flex-col space-y-2 z-50 hidden md:flex">
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="1"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="2"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="3"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="4"></div>
    </div>

    <?php include 'components/scrollscript.php'; ?>

    <!-- Script for Fade-in Animations -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const elements = document.querySelectorAll(".fade-in");
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                    }
                });
            }, { threshold: 0.3 });

            elements.forEach(element => observer.observe(element));
        });
    </script>





    <!-- footer -->
    <?php include 'components/footer.php'; ?>
</body>

</html>