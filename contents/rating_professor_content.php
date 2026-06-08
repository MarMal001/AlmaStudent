<form action="create_rating_professor.php" method="POST" enctype="multipart/form-data" class="w-75 mx-auto">
    <ul>
        <li><div class="text-secondary small mt-5 ms-1 mb-2">I campi con * sono da riempire obbligatoriamente</div></li>
        <?php foreach ($dbh->getProfessorsByCourse($templateParams["course"]) as $professor): ?>
            <div class="container-fluid w-auto p-0 mb-4 mt-0">
                <div class="bg-primary-subtle border border-secondary-subtle rounded text-start">
                    <div class="d-flex justify-content-between align-items-center fw-bold p-3 pb-2" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $professor["professor"]; ?>">
                        <h4 class="m-0 text-start text-darkbluenavy">Recensisci: <?php echo $professor["name"] . " " . $professor["surname"]; ?></h4>
                        <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                    </div>
                    <div id="<?php echo $professor["professor"]; ?>" class="collapse p-3 w-100 show">
                        <li>
                            <label for="lectures" class="mb-2">Quanto è risultato disponibile il docente durante il corso? *</label>
                        </li>
                        <li>
                            <label for="1starD<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                            <input type="radio" id="1starD<?php echo $professor["professor"]; ?>" name="ratingD<?php echo $professor["professor"]; ?>" value="1" class="form-check-input me-2" required>
                            <label for="2starD<?php echo $professor["professor"]; ?>">2</label>
                            <input type="radio" id="2starD<?php echo $professor["professor"]; ?>" name="ratingD<?php echo $professor["professor"]; ?>" value="2" class="form-check-input me-2">
                            <label for="3starD<?php echo $professor["professor"]; ?>">3</label>
                            <input type="radio" id="3starD<?php echo $professor["professor"]; ?>" name="ratingD<?php echo $professor["professor"]; ?>" value="3" class="form-check-input me-2">
                            <label for="4starD<?php echo $professor["professor"]; ?>">4</label>
                            <input type="radio" id="4starD<?php echo $professor["professor"]; ?>" name="ratingD<?php echo $professor["professor"]; ?>" value="4" class="form-check-input me-2">
                            <label for="5starD<?php echo $professor["professor"]; ?>">5</label>
                            <input type="radio" id="5starD<?php echo $professor["professor"]; ?>" name="ratingD<?php echo $professor["professor"]; ?>" value="5" class="form-check-input me-2">
                        </li>
                        <li>
                            <label for="material" class="mt-4 mb-2">Quanto sono comprensibili le lezioni tenute dal docente? *</label>
                        </li>
                        <li>
                            <label for="1starC<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                            <input type="radio" id="1starC<?php echo $professor["professor"]; ?>" name="ratingC<?php echo $professor["professor"]; ?>" value="1" class="form-check-input me-2" required>
                            <label for="2starC<?php echo $professor["professor"]; ?>">2</label>
                            <input type="radio" id="2starC<?php echo $professor["professor"]; ?>" name="ratingC<?php echo $professor["professor"]; ?>" value="2" class="form-check-input me-2">
                            <label for="3starC<?php echo $professor["professor"]; ?>">3</label>
                            <input type="radio" id="3starC<?php echo $professor["professor"]; ?>" name="ratingC<?php echo $professor["professor"]; ?>" value="3" class="form-check-input me-2">
                            <label for="4starC<?php echo $professor["professor"]; ?>">4</label>
                            <input type="radio" id="4starC<?php echo $professor["professor"]; ?>" name="ratingC<?php echo $professor["professor"]; ?>" value="4" class="form-check-input me-2">
                            <label for="5starC<?php echo $professor["professor"]; ?>">5</label>
                            <input type="radio" id="5starC<?php echo $professor["professor"]; ?>" name="ratingC<?php echo $professor["professor"]; ?>" value="5" class="form-check-input me-2">
                        </li>
                        <li>
                            <label class="mt-4 mb-2">Il docente suscita interesse nei confronti della materia? *</label>
                        </li>
                        <li>
                            <label for="1starI<?php echo $professor["professor"]; ?>" class="ms-4">1</label>
                            <input type="radio" id="1starI<?php echo $professor["professor"]; ?>" name="ratingI<?php echo $professor["professor"]; ?>" value="1" class="form-check-input me-2" required>
                            <label for="2starI<?php echo $professor["professor"]; ?>">2</label>
                            <input type="radio" id="2starI<?php echo $professor["professor"]; ?>" name="ratingI<?php echo $professor["professor"]; ?>" value="2" class="form-check-input me-2">
                            <label for="3starI<?php echo $professor["professor"]; ?>">3</label>
                            <input type="radio" id="3starI<?php echo $professor["professor"]; ?>" name="ratingI<?php echo $professor["professor"]; ?>" value="3" class="form-check-input me-2">
                            <label for="4starI<?php echo $professor["professor"]; ?>">4</label>
                            <input type="radio" id="4starI<?php echo $professor["professor"]; ?>" name="ratingI<?php echo $professor["professor"]; ?>" value="4" class="form-check-input me-2">
                            <label for="5starI<?php echo $professor["professor"]; ?>">5</label>
                            <input type="radio" id="5starI<?php echo $professor["professor"]; ?>" name="ratingI<?php echo $professor["professor"]; ?>" value="5" class="form-check-input me-2">
                        </li>
                        <li>
                            <label for="review<?php echo $professor["professor"]; ?>" class="mt-4 mb-2">Se desideri poi lasciare qui sotto una recensione scritta della tua esperienza con questo docente:</label>
                        </li>
                        <li>
                            <textarea id="review<?php echo $professor["professor"]; ?>" name="review<?php echo $professor["professor"]; ?>" class="form-control mt-2" maxlength="1000"></textarea>
                        </li>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <li class="d-flex justify-content-end">
            <input type="submit" value="Invia" class="btn btn-deepskyblue mb-5" />
        </li>
    </ul>
    <input type="hidden" id="course" name="course" value="<?php echo $templateParams["course"]; ?>">
</form>
