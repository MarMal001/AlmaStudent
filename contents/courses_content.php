<main>
    <section>
        <label for="courses">Filtra per corso di laurea</label>
        <select name="courses">
            <option value="--" disabled selected hidden>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["name"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2">
        <?php for($year = 1; $year <= $dbh->getYearsDegree(6673); $year++): ?>
            <h3><?php echo parseCourseYear($year); ?> anno</h3>
            <?php $courses = $dbh->getCoursesByDegreeAndYear(6673, $year); ?>
            <?php foreach ($courses as $course): ?>
                <div class="container-fluid w-auto w-lg-55 m-2 p-0">
                    <?php $courseId = $course["code"]; ?>
                    <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $courseId; ?>">
                        <div class="d-md-inline-flex align-items-md-center p-0">
                            <p class="m-0 p-2 text-start"><?php echo $course["name"]; ?></p>
                            <div>
                                <?php $ratings = [$course["ratingL"], $course["ratingM"], $course["ratingE"], $course["ratingD"]]; ?>
                                <?php echo createStars(getMeanRating($ratings),"rgb(30, 48, 80)"); ?>
                            </div>
                                <?php if (isStudent() && $dbh->checkIfSubscribedToACourse($user, $courseId)[0]["subscribed"]): ?>
                                    <i class="fa-solid fa-check mx-2" style="color: rgb(38, 246, 30);"></i>
                                <?php endif; ?>
                        </div>
                        <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
                    </button>
                    
                    <div id="<?php echo $courseId; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
                        <?php $professors = $dbh->getProfessorsByCourse($courseId); ?>
                            <ul class="d-flex flex-column align-items-start">
                            <?php foreach($professors as $professor): ?>
                                <li><a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="text-primary"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        <p><?php echo $course["shortDescription"]; ?></p>
                        <div class="d-flex justify-content-end m-2">
                            <a href="course.php?course=<?php echo $courseId; ?>" class="btn btn-primary me-1">Apri corso</a>
                            <?php if (isStudent())
                                subscriptionButton($user, $courseId); 
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endfor; ?>

    </section>
</main>    