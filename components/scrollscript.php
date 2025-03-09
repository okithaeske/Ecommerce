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
    <!-- Script for Scroll Indicator -->
    <script>
        const dots = document.querySelectorAll(".dot");
        const sections = document.querySelectorAll("h1");

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

</body>

</html>