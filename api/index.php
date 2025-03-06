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

    <!-- hero content -->
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

    <!-- Scrollable Sections -->
    <div class="relative h-screen flex items-center justify-center bg-gray-100 snap-start">
        <h1 class="text-6xl font-bold text-black">Elegance Redefined</h1>
    </div>

    <div class="relative h-screen flex items-center justify-center bg-gray-200 snap-start">
        <h1 class="text-6xl font-bold text-black">Timeless Craftsmanship</h1>
    </div>

    







    <!-- footer -->
    <?php include '../components/footer.php'; ?>
</body>

</html>