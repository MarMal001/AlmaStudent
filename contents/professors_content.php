<main>
    <section>
        <label for="courses">Filtra per corso di laurea</label>
        <select name="courses">
            <option value="--" disabled selected hidden>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["name"] ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2">
        <?php $professors = $dbh->getProfessorsByDegree("6673"); ?>
        <?php foreach($professors as $professor): ?>
        <div class="container-fluid w-auto w-lg-55 m-2 p-0">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $professor['professor']; ?>">
            <div class="d-md-inline-flex align-items-md-center p-0">
                <p class="m-0 p-2 text-start"><?php echo $professor["name"] . " " . $professor["surname"]; ?></p>
                <div>
                    <?php $ratings = [$professor["ratingD"], $professor["ratingC"], $professor["ratingD"]]; ?>
                    <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
                </div>
            </div>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <div id="<?php echo $professor['professor']; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <h6>Corsi:</h6>
            <ul class="d-flex flex-column align-items-start">
            <?php $courses = $dbh->getCoursesByProfessor($professor["professor"]); ?> 
            <?php foreach($courses as $course): ?>
                <li><a href="course.php?course=<?php echo $course["code"]; ?>" class="text-primary"><?php echo $course["name"]; ?></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="d-flex justify-content-end m-2">
                <a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="btn btn-primary me-1">Vai alla pagina</a>
            </div>
        </div>
        </div>
        <?php endforeach; ?>
    </section>
</main>    