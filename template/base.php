<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php foreach ($templateParams["style"] as $stylesheet): ?>
    <link rel="stylesheet" href="<?php echo $stylesheet; ?>"> 
    <?php endforeach; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Playwrite+GB+J:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/functions.js"></script>
    <title><?php echo $templateParams["title"]; ?></title>
</head>
<body>
    <header class="container-fluid d-flex justify-content-between pt-4 mb-0 px-0 bg-deepskyblue text-white text-center">
        <a href="index.php" class="d-inline-flex align-items-center mb-3 ms-5">
            <img src="images/logo.png" class="img-fluid object-fit-cover" alt="">
            <h1 class="mt-3">AlmaStudent</h1>
        </a>
        <?php if (isUserLoggedIn()): ?>
            <nav class="mt-5 me-0">
                <div onclick="mobileNavbarOnclick()">
                    <i class="fa-solid fa-bars py-3"></i>
                    <ul class="bg-deepskyblue">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="professors.php">Docenti</a></li>
                        <li><a href="courses.php">Corsi</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i></a></li>
                    </ul>
                </div>
            </nav>
        <?php endif; ?>
    </header>
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <p class="modal-title fs-5 p-0">Sei sicuro?</p>
                </div>

                <div class="modal-body">
                    Premendo conferma tornerai alla scermata di login
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary-subtle" data-bs-dismiss="modal">Annulla</button>
                    <a class="btn btn-deepskyblue" href="logout.php">Conferma</a>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($templateParams["content"])) {
        require("contents/" . $templateParams["content"]);
    }
    ?>
    <footer class="container-fluid p-2 bg-deepskyblue text-white text-center">© Copyright 2026 - ALMA MATER STUDIORUM - Università di Bologna</footer>
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
    <?php if(isset($templateParams["alert"])): ?>
        <script src="<?php echo $templateParams["alert"]; ?>"></script>
    <?php endif; ?>
</body>
</html>
