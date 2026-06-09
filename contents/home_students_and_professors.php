<div class="mx-5 mt-5">
    <?php $userData = $dbh->getPersonInfo($user)[0]; ?>
    <?php showMessage(); ?>
    <h1 class="fw-bold mt-3">Ciao <?php echo $userData["name"]; ?>!</h1>
    <p class="pb-0">Gestisci facilmente e velocemente i tuoi corsi.</p>
    <?php if (isStudent() && $dbh->isStudentBanned($user)): ?>
        <div class="card text-center my-3">
            <div class="card-body bg-darkred text-white rounded p-4">
                <i class="fa-solid fa-triangle-exclamation mb-4" style="color: rgb(255, 255, 255); font-size: 32px"></i>
                <h5 class="fw-bold">Sei stato bloccato!</h5>
                <p>Avendo raggiunto un numero di segnalazioni pari a tre non sarà possibile eseguire recensioni per la durata di un mese. Al primo accesso dopo un mese dal blocco potrai nuovamente recensire e il numero di segnalazioni sarà portato a zero.     
                </p>
                <p class="text-center border border-light rounded">Ti restano <?php echo $dbh->getRemainingBanDays($user); ?> giorni prima che avvenga lo sblocco</p>
            </div>
        </div>
    <?php endif; ?> 
</div>
<section class="mx-5 mt-4">
    <h2 class="fw-bold mb-3">I tuoi corsi</h2>
    <?php
        if (isStudent()) {
            $courses = $dbh->getStudentCourses($user);
            $reservations = $dbh->getReservationsOfStudent($user);
        } else if (isProfessor()) {
            $courses = $dbh->getCoursesByProfessor($user);
            $reservations = $dbh->getReservationsOfProfessor($user);
        } else {
            header("location: login.php");
        }
    ?>
    <?php foreach($courses as $course): ?>
        <div class="container-fluid w-auto m-2 p-0">
            <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-100 p-0">
                <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between text-darkbluenavy align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
                    <span class="d-md-inline-flex align-items-md-center ps-2">
                        <?php echo $course["name"]; ?>
                        <span class="ms-md-2">
                            <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                            <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                            <?php createStars(getMeanRating($ratings), "#154388"); ?>
                        </span>
                    </span>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </button>
                <div id="<?php echo $course["code"]; ?>" class="collapse p-4 w-100">
                    <?php $professors = $dbh->getProfessorsByCourse($course["code"]); ?>
                        <ul class="d-flex flex-column align-items-start">
                        <?php foreach($professors as $professor): ?>
                            <li><a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="link-deepskyblue"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    <p><?php echo $course["shortDescription"]; ?></p>
                    <div class="d-flex justify-content-end">
                        <?php if (isStudent() && $dbh->canRateCourse($user, $course["code"])[0]["existence"] && !$dbh->courseIsAlreadyRated($user, $course["code"])): ?>
                            <?php if ($dbh->isStudentBanned($user)): ?>
                                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Sei stato bloccato">
                                    <a href="rating.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-2 mt-2 disabled">Recensisci</a>
                                </div>
                            <?php else: ?>
                                <a href="rating.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-2 mt-2">Recensisci</a>
                            <?php endif; ?>
                        <?php elseif (isStudent() && $dbh->canRateCourse($user, $course["code"])[0]["existence"] && $dbh->courseIsAlreadyRated($user, $course["code"]) && !$dbh->professorsOfCourseAlreadyRated($user, $course["code"])): ?>
                            <?php if ($dbh->isStudentBanned($user)): ?>
                                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Sei stato bloccato">
                                    <a href="rating_professor.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-2 mt-2 disabled">Recensisci docenti</a>
                                </div>
                            <?php else: ?>
                                <a href="rating_professor.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-2 mt-2">Recensisci docenti</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="course.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-1 mt-2">Apri corso</a>
                        <?php if(isStudent()) {
                            subscriptionButton($user, $course["code"]);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (count($courses) == 0): ?>
        <div class="m-2 p-0"><?php echo isStudent() ? "Non sei iscritto a nessun corso" : "Non hai nessun corso assegnato"; ?></div>
    <?php endif; ?>
</section>
<section class="mx-5 mt-4 mb-5">
    <h2 class="fw-bold mb-3">I tuoi ricevimenti</h2>
    <ul>
        <?php foreach($reservations as $reservation): ?>
            <?php if ($reservation["name"] != NULL): ?>
                <?php $timeRange = date("H:i", strtotime($reservation["startTime"])) . "-" . date("H:i", strtotime($reservation["endTime"])); ?>
                <li><?php echo $reservation["date"] . " " . $timeRange . " " . $reservation["name"] . " " . $reservation["surname"] . " - " . $reservation["mode"]; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php if (isStudent() && count($reservations) == 0): ?>
        <div class="m-2 p-0"><?php echo "Non hai prenotato nessun ricevimento"; ?></div>
    <?php elseif (isProfessor() && count($dbh->getReservedReservationsOfProfessor($user)) == 0): ?>
        <div class="m-2 p-0"><?php echo "Non hai ricevimenti prenotati"; ?></div>
    <?php endif; ?>
</section>
