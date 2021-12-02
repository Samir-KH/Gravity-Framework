<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="styles/images/INSEA_logo2.png">
    <link rel="stylesheet"  href="<?php provide("css/streaming.css")?>">
    <title>iron</title>
</head>
<body>  
    <div class="container">
        <video class="video" controls>
            <source src ="<?php addUrlRoute($routes, "streaming");?>" type="video/mp4">
        </video>
    </div>       
</body>
</html>


