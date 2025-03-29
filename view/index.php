<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../assets/tailwind.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>

<body>
    <!-- navbar -->
    <?php include '../components/header.php'; ?>


    <!-- Hero Section -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute top-0 left-0 w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/heroindex.mp4" type="video/mp4">
        </video>
        <!-- Dark Overlay & Text -->
        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white px-4">
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold text-center leading-tight">Own The Seconds</h1>
        </div>
    </div>

    <!-- Section 1 -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/section1.mp4" type="video/mp4">
        </video>
        <div class="relative h-screen flex items-center justify-center bg-gray-100 bg-opacity-60 px-4">
            <h1 class="text-3xl sm:text-5xl font-bold text-black text-center">Elegance Redefined</h1>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="relative w-full h-screen overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay loop muted>
            <source src="../assets/video/section2.mp4" type="video/mp4">
        </video>
        <div class="relative h-screen flex items-center justify-center bg-gray-100 bg-opacity-5 px-4">
            <h1 class="text-3xl sm:text-5xl font-bold text-white text-center">Timeless Craftsmanship</h1>
        </div>
    </div>

    <!-- Art & Creativity Section -->
    <div
        class="flex flex-col md:flex-row items-center justify-center w-full h-auto md:h-screen px-4 md:px-10 py-10 bg-gray-900 text-white">
        <!-- Left Side - Image -->
        <div class="w-full md:w-1/2 flex justify-center mb-6 md:mb-0">
            <img src="../assets/images/section3.jpeg" alt="Time meets Art"
                class="w-screen md:w-auto shadow-lg h-auto md:h-screen object-cover">
        </div>

        <!-- Right Side - Text -->
        <div class="w-full md:w-1/2 text-left p-4 md:p-12">
            <h1 class="text-3xl sm:text-4xl font-bold mb-4">Zentara: Where Time Meets Art</h1>
            <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                At Zentara, we don’t just tell time—we tell stories. Our watches are more than just tools for keeping
                track of moments;
                they are an embodiment of artistic vision, innovation, and style. Every piece is a canvas, each design a
                brushstroke of culture,
                passion, and creativity. We work hand in hand with artists, blending their masterpieces with precision
                engineering,
                so you can wear art that moves with you. Zentara isn’t just a brand;
                it’s an artistic revolution on your wrist. Join us, and let every second be a work of art.
            </p>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="fixed right-5 top-1/2 transform -translate-y-1/2 flex-col space-y-2 z-50 hidden md:flex">
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="1"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="2"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="3"></div>
        <div class="dot w-3 h-3 rounded-full bg-gray-400 transition-all" data-section="4"></div>
    </div>


    <!-- Script for Scroll Indicator -->
    <?php include '../components/scrollscript.php'; ?>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

</body>


</html>