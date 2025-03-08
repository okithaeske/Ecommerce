<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background_Music</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <!-- Mute/Unmute Button -->
    <button id="muteButton" class="fixed top-3 left-5 bg-gold text-black p-3 rounded-lg z-50">
        <i id="muteIcon" class="fa-solid fa-volume-high"></i>
    </button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bgMusic = document.getElementById("bgMusic");
            const muteButton = document.getElementById("muteButton");
            const muteIcon = document.getElementById("muteIcon");

            muteButton.addEventListener("click", function () {
                if (bgMusic.muted) {
                    bgMusic.muted = false;
                    muteIcon.classList.remove("fa-volume-xmark");
                    muteIcon.classList.add("fa-volume-high");
                } else {
                    bgMusic.muted = true;
                    muteIcon.classList.remove("fa-volume-high");
                    muteIcon.classList.add("fa-volume-xmark");
                }
            });
        });
    </script>


    <audio id="bgMusic" autoplay>
        <source src="../assets/mp3/bgmusic.mp3" type="audio/mp3">
    </audio>

    <script>
        document.getElementById("bgMusic").volume = 0.03; // Set volume to 3%
    </script>

</body>

</html>