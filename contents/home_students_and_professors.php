<section>
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci facilmente e velocemente i tuoi corsi.</div>
</section>
<section>
    <h1 class="fw-bold">I tuoi corsi</h1>
    <?php
        if (isStudent()) {
            $courses = $dbh->getStudentCourses($user);
            $reservations = $dbh->getReservationsOfStudent($user, $date);
        } else if (isProfessor()) {
            $courses = $dbh->getCoursesByProfessor($user);
            $reservations = $dbh->getReservationsOfProfessor($user, $date);
        } else {
            header("location: login.php");
        }
    ?>
    <?php foreach($courses as $course): ?>
        <div class="container-fluid w-auto m-2 p-0">
            <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
                <div class="d-md-inline-flex align-items-md-center p-0">
                    <p class="m-0  p-2 text-start"><?php echo $course["name"]; ?></p>
                    <div>
                        <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                        <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                        <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
                    </div>
                </div>
                <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
            </button>
            
            <div id="<?php echo $course["code"]; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
                <?php $professors = $dbh->getProfessorsByCourse($course["code"]); ?>
                    <ul class="d-flex flex-column align-items-start">
                    <?php foreach($professors as $professor): ?>
                        <li><a href="professor.php?professor=<?php echo $professor["professor"]; ?>" class="text-primary"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                <p><?php echo $course["shortDescription"]; ?></p>
                <div class="d-flex justify-content-end m-2">
                    <button class="btn btn-primary me-1" type="submit">Apri corso</button>
                    <button class="btn btn-white border-primary ms-1" type="submit">Discriviti</button>
                </div>
            </div>
        </div>    
    <?php endforeach; ?>
</section>
<section>
    <h1 class="fw-bold">I tuoi ricevimenti</h1>
    <ul>
        <?php $date = "12 Aprile 2026"; ?>
        <?php foreach($reservations as $reservation): ?>
            <?php if ($reservation["name"] != NULL): ?>
                <?php $timeRange = date("H:i", strtotime($reservation["startTime"])) . "-" . date("H:i", strtotime($reservation["endTime"])); ?>
                <li><?php echo $date . " " . $timeRange . " " . $reservation["name"] . " " . $reservation["surname"] . " - " . $reservation["mode"]; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>