<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php foreach ($templateParams["style"] as $stylesheet): ?>
    <link rel="stylesheet" href="<?php echo $stylesheet; ?>"> 
    <?php endforeach; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <title><?php echo $templateParams["title"]; ?></title>
</head>
<body>
    <header class="container-fluid py-5 px-1 bg-primary text-white text-center">
        <div class="d-inline-flex">
            <img src="images/logo.png" class="img-fluid" alt="">
            <h1>AlmaStudent</h1>
        </div>
        <?php if ($templateParams["content"] != "login_content.php"): ?>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="professors.php">Docenti</a></li>
                <li><a href="courses.php">Corsi</a></li>
                <li><a href="reception.php">Ricevimenti</a></li>
                <li><a href="contacts.php">Contatti</a></li>
                <li><i class="fa-solid fa-bars"></i></li>
            </ul>
        </nav>
        <?php endif; ?>
    </header>
    <?php
    if (isset($templateParams["content"])) {
        require("contents/" . $templateParams["content"]);
    }
    ?>
    <footer class="container-fluid p-2 bg-primary text-white text-center">© Copyright 2026 - ALMA MATER STUDIORUM - Università di Bologna</footer>
</body>
</html>