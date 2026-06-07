<form action="create_rating_course.php" method="POST" enctype="multipart/form-data" class="w-75 mx-auto">
    <ul>
        <li><div class="text-secondary small mt-5 ms-1 mb-2">I campi con * sono da riempire obbligatoriamente</div></li>
        <div class="container-fluid w-auto p-3 mb-4 mt-0 bg-primary-subtle border border-secondary-subtle rounded">
            <li class="mb-4 fw-bold text-darkbluenavy"><h4>Recensisci: <?php echo $GLOBALS["dbh"]->getCourseInfo($templateParams["course"])[0]["name"]; ?></h4></li>
            <li>
                <label for="lectures" class="mb-2">Quanto sono risultate interessanti e comprensibili le lezioni frequentate? *</label>
            </li>
            <li>
                <label for="ratingL" class="ms-4">1</label>
                <input class="form-check-input me-2" type="radio" id="1star" name="ratingL" value="1" class="me-2" required>
                <label for="ratingL">2</label>
                <input class="form-check-input me-2" type="radio" id="2star" name="ratingL" value="2" class="me-2">
                <label for="ratingL">3</label>
                <input class="form-check-input me-2" type="radio" id="3star" name="ratingL" value="3" class="me-2">
                <label for="ratingL">4</label>
                <input class="form-check-input me-2" type="radio" id="4star" name="ratingL" value="4" class="me-2">
                <label for="ratingL">5</label>
                <input class="form-check-input me-2" type="radio" id="5star" name="ratingL" value="5">
            </li>
            <li>
                <label for="material" class="mt-4 mb-2">Quanto è stato utile il materiale del corso? *</label>
            </li>
            <li>
                <label for="ratingM" class="ms-4">1</label>
                <input class="form-check-input me-2" type="radio" id="1star" name="ratingM" value="1" class="me-2" required>
                <label for="ratingM">2</label>
                <input class="form-check-input me-2" type="radio" id="2star" name="ratingM" value="2" class="me-2">
                <label for="ratingM">3</label>
                <input class="form-check-input me-2" type="radio" id="3star" name="ratingM" value="3" class="me-2">
                <label for="ratingM">4</label>
                <input class="form-check-input me-2" type="radio" id="4star" name="ratingM" value="4" class="me-2">
                <label for="ratingM">5</label>
                <input class="form-check-input me-2" type="radio" id="5star" name="ratingM" value="5">
            </li>
            <li>
                <label class="mt-4 mb-2">L'esame è coerente con quanto fatto a lezione e impostato in modo da favorirne un corretto svolgimento? *</label>
            </li>
            <li>
                <label for="ratingE" class="ms-4">1</label>
                <input class="form-check-input me-2" type="radio" id="1star" name="ratingE" value="1" class="me-2" required>
                <label for="ratingE">2</label>
                <input class="form-check-input me-2" type="radio" id="2star" name="ratingE" value="2" class="me-2">
                <label for="ratingE">3</label>
                <input class="form-check-input me-2" type="radio" id="3star" name="ratingE" value="3" class="me-2">
                <label for="ratingE">4</label>
                <input class="form-check-input me-2" type="radio" id="4star" name="ratingE" value="4" class="me-2">
                <label for="ratingE">5</label>
                <input class="form-check-input me-2" type="radio" id="5star" name="ratingE" value="5">
            </li>
            <li>
                <label for="review" class="mt-4 mb-2">Se desideri poi lasciare qui sotto una recensione scritta della tua esperienza in questo corso:</label>
            </li>
            <li>
                <textarea id="review" name="review" class="form-control mt-2" maxlength="1000"></textarea>
            </li>
        </div>
        <li class="d-flex justify-content-end">
            <input type="submit" value="Passa alla recensione docenti" class="btn btn-deepskyblue me-5 mb-5" />
        </li>
    </ul>
    <input type="hidden" id="course" name="course" value="<?php echo $templateParams["course"]; ?>">
</form>
