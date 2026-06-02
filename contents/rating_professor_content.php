
<form action="create_rating_professor.php" method="POST" enctype="multipart/form-data">
    <ul>
        <li><label class="text-secondary small mt-5 mb-2 mx-5">I campi con * sono da riempire obbligatoriamente</label></li>
        <?php foreach ($dbh->getProfessorsByCourse($templateParams["course"]) as $professor): ?>
                    <div class="container-fluid w-auto w-lg-55 mt-0 mb-3 mx-5 p-0">
                        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $professor["professor"]; ?>">
                        <p class="m-0 p-2 text-start">Recensisci: <?php echo $professor["name"] . " " . $professor["surname"]; ?></p>
                        <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
                    </button>
                        <div id="<?php echo $professor["professor"]; ?>" class="collapse show p-3 w-100 border border-primary border-2 rounded">
                            <li>
                                <label for="lectures" class="mb-2">Quanto è risultato disponibile il docente durante il corso? *</label>
                            </li>
                            <li>
                                <label for="ratingD<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                                <input type="radio" id="1star" name="ratingD<?php echo $professor["professor"]; ?>" value="1" class="me-2" required>
                                <label for="ratingD<?php echo $professor["professor"]; ?>">2</label>
                                <input type="radio" id="2star" name="ratingD<?php echo $professor["professor"]; ?>" value="2" class="me-2">
                                <label for="ratingD<?php echo $professor["professor"]; ?>">3</label>
                                <input type="radio" id="3star" name="ratingD<?php echo $professor["professor"]; ?>" value="3" class="me-2">
                                <label for="ratingD<?php echo $professor["professor"]; ?>">4</label>
                                <input type="radio" id="4star" name="ratingD<?php echo $professor["professor"]; ?>" value="4" class="me-2">
                                <label for="ratingD<?php echo $professor["professor"]; ?>">5</label>
                                <input type="radio" id="5star" name="ratingD<?php echo $professor["professor"]; ?>" value="5">
                            </li>
                            <li>
                                <label for="material" class="mt-4 mb-2">Quanto sono comprensibili le lezioni tenute dal docente? *</label>
                            </li>
                            <li>
                                <label for="ratingC<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                                <input type="radio" id="1star" name="ratingC<?php echo $professor["professor"]; ?>" value="1" class="me-2" required>
                                <label for="ratingC<?php echo $professor["professor"]; ?>">2</label>
                                <input type="radio" id="2star" name="ratingC<?php echo $professor["professor"]; ?>" value="2" class="me-2">
                                <label for="ratingC<?php echo $professor["professor"]; ?>">3</label>
                                <input type="radio" id="3star" name="ratingC<?php echo $professor["professor"]; ?>" value="3" class="me-2">
                                <label for="ratingC<?php echo $professor["professor"]; ?>">4</label>
                                <input type="radio" id="4star" name="ratingC<?php echo $professor["professor"]; ?>" value="4" class="me-2">
                                <label for="ratingC<?php echo $professor["professor"]; ?>">5</label>
                                <input type="radio" id="5star" name="ratingC<?php echo $professor["professor"]; ?>" value="5">
                            </li>
                            <li>
                                <label class="mt-4 mb-2">Il docente suscita interesse nei confronti della materia? *</label>
                            </li>
                            <li>
                                <label for="ratingI<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                                <input type="radio" id="1star" name="ratingI<?php echo $professor["professor"]; ?>" value="1" class="me-2" required>
                                <label for="ratingI<?php echo $professor["professor"]; ?>">2</label>
                                <input type="radio" id="2star" name="ratingI<?php echo $professor["professor"]; ?>" value="2" class="me-2">
                                <label for="ratingI<?php echo $professor["professor"]; ?>">3</label>
                                <input type="radio" id="3star" name="ratingI<?php echo $professor["professor"]; ?>" value="3" class="me-2">
                                <label for="ratingI<?php echo $professor["professor"]; ?>">4</label>
                                <input type="radio" id="4star" name="ratingI<?php echo $professor["professor"]; ?>" value="4" class="me-2">
                                <label for="ratingI<?php echo $professor["professor"]; ?>">5</label>
                                <input type="radio" id="5star" name="ratingI<?php echo $professor["professor"]; ?>" value="5">
                            </li>
                            <li>
                                <label for="review<?php echo $professor["professor"]; ?>" class="mt-4 mb-2">Se desideri poi lasciare qui sotto una recensione scritta della tua esperienza con questo docente:</label>
                            </li>
                            <li>
                                <textarea id="review<?php echo $professor["professor"]; ?>" name="review<?php echo $professor["professor"]; ?>" class="form-control mt-2"></textarea>
                            </li>
                        </div>
                    </div>
        <?php endforeach; ?>
        <li class="d-flex justify-content-end">
            <input type="submit" value="Invia" class="btn btn-primary me-5 mb-5" />
        </li>
    </ul>
    <input type="hidden" id="course" name="course" value="<?php echo $templateParams["course"]; ?>">
</form>