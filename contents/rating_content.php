<form action="create_rating_course.php" method="POST" enctype="multipart/form-data" class="w-75 mx-auto">
    <div class="text-secondary small mt-5 ms-1 mb-2">I campi con * sono da riempire obbligatoriamente</div>
    <ul class="container-fluid w-auto p-3 mb-4 mt-0 bg-primary-subtle border border-secondary-subtle rounded">
        <li class="mb-4 fw-bold text-darkbluenavy"><div class="fs-4">Recensisci: <?php echo $GLOBALS["dbh"]->getCourseInfo($templateParams["course"])[0]["name"]; ?></div></li>
        <li>
            <label class="mb-2">Quanto sono risultate interessanti e comprensibili le lezioni frequentate? *</label>
        </li>
        <li>
            <label for="1starL" class="ms-4">1</label>
            <input class="form-check-input me-2" type="radio" id="1starL" name="ratingL" value="1" required>
            <label for="2starL">2</label>
            <input class="form-check-input me-2" type="radio" id="2starL" name="ratingL" value="2">
            <label for="3starL">3</label>
            <input class="form-check-input me-2" type="radio" id="3starL" name="ratingL" value="3">
            <label for="4starL">4</label>
            <input class="form-check-input me-2" type="radio" id="4starL" name="ratingL" value="4">
            <label for="5starL">5</label>
            <input class="form-check-input me-2" type="radio" id="5starL" name="ratingL" value="5">
        </li>
        <li>
            <label class="mt-4 mb-2">Quanto è stato utile il materiale del corso? *</label>
        </li>
        <li>
            <label for="1starM" class="ms-4">1</label>
            <input class="form-check-input me-2" type="radio" id="1starM" name="ratingM" value="1" required>
            <label for="2starM">2</label>
            <input class="form-check-input me-2" type="radio" id="2starM" name="ratingM" value="2">
            <label for="3starM">3</label>
            <input class="form-check-input me-2" type="radio" id="3starM" name="ratingM" value="3">
            <label for="4starM">4</label>
            <input class="form-check-input me-2" type="radio" id="4starM" name="ratingM" value="4">
            <label for="5starM">5</label>
            <input class="form-check-input me-2" type="radio" id="5starM" name="ratingM" value="5">
        </li>
        <li>
            <label class="mt-4 mb-2">L'esame è coerente con quanto fatto a lezione e impostato in modo da favorirne un corretto svolgimento? *</label>
        </li>
        <li>
            <label for="1starE" class="ms-4">1</label>
            <input class="form-check-input me-2" type="radio" id="1starE" name="ratingE" value="1" required>
            <label for="2starE">2</label>
            <input class="form-check-input me-2" type="radio" id="2starE" name="ratingE" value="2">
            <label for="3starE">3</label>
            <input class="form-check-input me-2" type="radio" id="3starE" name="ratingE" value="3">
            <label for="4starE">4</label>
            <input class="form-check-input me-2" type="radio" id="4starE" name="ratingE" value="4">
            <label for="5starE">5</label>
            <input class="form-check-input me-2" type="radio" id="5starE" name="ratingE" value="5">
        </li>
        <li>
            <label for="review" class="mt-4 mb-2">Se desideri poi lasciare qui sotto una recensione scritta della tua esperienza in questo corso:</label>
        </li>
        <li>
            <textarea id="review" name="review" class="form-control mt-2" maxlength="1000"></textarea>
        </li>
    </ul>
    <div class="d-flex justify-content-end">
        <input type="submit" value="Passa alla recensione docenti" class="btn btn-deepskyblue mb-5" />
    </div>
    <input type="hidden" id="course" name="course" value="<?php echo $templateParams["course"]; ?>">
</form>
