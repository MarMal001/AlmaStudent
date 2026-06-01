<main>
    <section>
        <label for="courses">Filtra per corso di laurea</label>
        <select name="courses" id="degreeCode" onchange="getCoursesData()">
            <option value="" disabled selected hidden>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2" id="courses">
        <?php foreach ($dbh->getCourses() as $course): ?>
            <div class="container-fluid w-auto w-lg-55 m-2 p-0">
                <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
                    <div class="d-md-inline-flex align-items-md-center p-0">
                        <p class="m-0 p-2 text-start"><?php echo $course["code"] . " " . $course["name"] . ": " . $course["degreeName"] . " - " . $course["campus"]; ?></p>
                        <div>
                            <?php createStars(getMeanRating([$course["ratingL"], $course["ratingM"], $course["ratingE"], $course["ratingD"]]), "rgb(30, 48, 80)"); ?>
                        </div>
                        <?php if (isStudent() && $course["isSubscribed"]): ?>
                            <i class="fa-solid fa-check mx-2" style="color: rgb(38, 246, 30);"></i>
                        <?php endif; ?>
                    </div>
                    <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
                </button>
                <div id="<?php echo $course["code"]; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
                    <ul class="d-flex flex-column align-items-start">
                        <?php foreach ($dbh->getProfessorsByCourse($course["code"]) as $professor): ?>
                            <li><a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <p><?php echo $course["shortDescription"]; ?></p>
                    <div class="d-flex justify-content-end m-2">
                        <a href="course.php?course=<?php echo $course["code"]; ?>" class="btn btn-primary me-1">Apri corso</a>
                        <?php if (isStudent()) {
                            subscriptionButton($username, $course["code"]);
                        } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>    
