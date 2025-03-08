<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>

<body>
    <!-- navbar -->
    <?php include '../components/header.php'; ?>

    <!-- Hero Section -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute top-0 left-0 w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/herovid.mp4" type="video/mp4">
        </video>
        <!-- Dark Overlay & Text -->
        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white">
            <h1 class="text-5xl md:text-7xl font-bold text-center">Own The Seconds</h1>
        </div>
    </div>

    <!-- section 1 -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/section1.mp4" type="video/mp4">
        </video>
        <div class="relative h-screen flex items-center justify-center bg-gray-100 bg-opacity-60">
            <h1 class="text-6xl font-bold text-black">Elegance Redefined</h1>
        </div>
    </div>


    <!-- section 2 -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/section2.mp4" type="video/mp4">
        </video>

        <div class="relative h-screen flex items-center justify-center bg-gray-100 bg-opacity-5">
            <h1 class="text-6xl font-bold text-white ">Timeless Craftsmanship</h1>
        </div>
    </div>

    <!-- section 3 -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/section2.mp4" type="video/mp4">
        </video>

        <div class="relative h-screen flex items-center justify-center bg-gray-100 bg-opacity-5">
            <h1 class="text-6xl font-bold text-white ">Timeless Craftsmanship</h1>
        </div>
    </div>

















    <!-- Scroll indicator -->
    <div class="fixed right-5 top-1/2 transform -translate-y-1/2 flex flex-col space-y-2 z-50">
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="1"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="2"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="3"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="4"></div>
    </div>

    <!-- Script for Scroll Indicator -->

    <script>
        const dots = document.querySelectorAll(".dot");
        const sections = document.querySelectorAll("video"); // Assuming each section has a video

        function updateIndicator() {
            let current = "";
            sections.forEach((section, index) => {
                const sectionTop = section.getBoundingClientRect().top;
                if (sectionTop < window.innerHeight / 2) {
                    current = index;
                }
            });

            dots.forEach((dot, index) => {
                if (index === current) {
                    dot.classList.add("bg-red-500");
                } else {
                    dot.classList.remove("bg-red-500");
                }
            });
        }

        window.addEventListener("scroll", updateIndicator);
    </script>




    <!-- footer -->
    <?php include '../components/footer.php'; ?>
</body>

</html>