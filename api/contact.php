<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>

<body class="bg-black text-white font-sans">
    <!-- navbar -->
    <?php include '../components/header.php'; ?>
    <!-- Back ground music -->
    <?php include '../components/backmusic.php'; ?>

    <!-- Hero Section -->
    <div class="relative w-full h-screen flex items-center justify-center">
        <video class="absolute top-0 left-0 w-screen h-screen object-cover" autoplay loop muted>
            <source src="../assets/video/contacthero.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <h1 class="relative text-5xl md:text-7xl font-bold text-center">Get in Touch with Elegance</h1>
    </div>

    <!-- Contact Form Section -->
    <div class="flex justify-center items-center min-h-screen px-6">
        <div class="relative bg-white bg-opacity-10 p-8 rounded-xl shadow-lg w-full max-w-2xl backdrop-blur-md">
            <h2 class="text-3xl font-bold text-center text-gold mb-6">Let's Talk</h2>

            <form class="space-y-4">
                <div>
                    <label class="block text-sm text-gray-300">Your Name</label>
                    <input type="text"
                        class="w-full p-3 bg-transparent border border-gray-400 rounded-lg focus:outline-none focus:border-gold text-white">
                </div>
                <div>
                    <label class="block text-sm text-gray-300">Email</label>
                    <input type="email"
                        class="w-full p-3 bg-transparent border border-gray-400 rounded-lg focus:outline-none focus:border-gold text-white">
                </div>
                <div>
                    <label class="block text-sm text-gray-300">Message</label>
                    <textarea
                        class="w-full p-3 bg-transparent border border-gray-400 rounded-lg focus:outline-none focus:border-gold text-white"
                        rows="4"></textarea>
                </div>
                <button class="w-full bg-gold text-black font-bold py-3 rounded-lg hover:bg-yellow-600 transition-all">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-400 text-sm">
        © 2025 Zentara. All rights reserved.
    </footer>

    <style>
        .text-gold {
            color: #FFD700;
        }

        .bg-gold {
            background-color: #FFD700;
        }

        .border-gold {
            border-color: #FFD700;
        }
    </style>

</body>

</html>