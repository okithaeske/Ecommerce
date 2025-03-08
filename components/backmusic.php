<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background_Music</title>
</head>

<body>
    <audio id="bgMusic" autoplay loop>
        <source src="../assets/mp3/bgmusic.mp3" type="audio/mp3">
    </audio>

    <script>
        document.getElementById("bgMusic").volume = 0.05; // Set volume to 20%
    </script>
</body>

</html>