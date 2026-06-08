<main class="p-5">
    <?php 
        $courseId = $templateParams["course"]; 
        $page = explode("/", $_SERVER['REQUEST_URI'])[2];    
    ?>
    <input type="hidden" id="course" value=<?php echo $courseId;?> />
    <input type="hidden" id="url" value=<?php echo $page;?> />
    <input type="hidden" id="type" value="course" />
    <?php $courseInfo = $dbh->getCourseInfo($courseId)[0]; ?>  
    <?php $professors = $dbh->getProfessorsByCourse($courseId); ?>
    <h1><?php echo $courseInfo["name"]; ?></h1>
    <section>
        <h3>
            <?php foreach($professors as $professor): ?>
                <a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="link-deepskyblue"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a>
            <?php endforeach; ?>
        </h3>
        <?php $gRatings = $dbh->getGeneralRatingsByCourse($courseId)[0]; ?>
        <div class="d-flex align-items-start align-items-center">
            <h6 class="m-0 me-2">Rating degli studenti:</h6>
            <div data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Lezioni:</p>
                    <?php createStars($gRatings["ratingL"], "#ffff"); ?>
                </div>
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Materiale:</p>
                    <?php createStars($gRatings["ratingM"], "#ffff"); ?>
                </div>
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Esame:</p>
                    <?php createStars($gRatings["ratingE"], "#ffff"); ?>
                </div>
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Disponibilità:</p>
                    <?php createStars($dbh->getProfessorsDisponibilityOfCourse($courseId), "#ffff"); ?>
                </div>
            ">
                <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                <?php createStars(getMeanRating($ratings), "#154388"); ?>
            </div>
        </div>
        <div class="mb-4">
            <?php
                if (isStudent())
                    subscriptionButton($user, $courseId);
            ?>
            <?php 
            if (isProfessor() && isDesignatedProfessor($user, $courseId)): ?>
                <a href="course_editable.php?course=<?php echo $courseId; ?>" class="btn btn-deepskyblue me-1">Modifica</a>
            <?php endif; ?>
        </div>
    </section>
    <article class="mb-4">
        <h2>Descrizione</h2>
        <p class="mt-3 pt-0">
            <?php echo $courseInfo["description"]; ?>
        </p>
    </article>
    <article class="mb-4">
        <h2>Materiale</h2>
        <p class="mt-3 pt-0">
            <?php echo $courseInfo["material"]; ?>
        </p>
    </article>
    <section>
        <h2>Opinioni degli studenti</h2>
        <div class="d-inline-flex ms-3 mt-2">
            <label for="reviewsNumber" class="mt-2">Visualizza: </label>
            <select name="reviewsNumber" id="reviewsNumber" class="rounded-pill form-select ms-2" onChange="getSelectedCourseReviewsForm()">
                <option value="" selected>Tutte</option>
                <option value="5">ultime 5</option>
                <option value="10">ultime 10</option>
                <option value="50">ultime 50</option>
            </select>
        </div>

        <?php $reviews = $dbh->getReviewsByCourse($courseId);
            $noReviews = false;
            $style = "";
            if ($reviews == NULL) {
                    $style = "d-flex justify-content-center align-items-center";
                    $noReviews = true;
            } 
        ?>

        <div class="card mb-3 mt-3 mx-3" style="height: clamp(200px, 60vh, 300px);">
            <div class="card-body overflow-auto bg-light-subtle <?php echo $style; ?>" id="courseReviews">
                <?php if ($noReviews): ?>
                    <h5 class="text-center text-secondary fw-normal">Non è presente ancora nessuna recensione</h5>
                <?php endif; ?>
            </div>
        </div>
        <?php if (isStudent()): ?>
            <div class="d-flex justify-content-end mb-5 me-2">
                <?php if ($dbh->canRateCourse($user, $courseId)[0]["existence"] && !$dbh->courseIsAlreadyRated($user, $courseId) && $dbh->isStudentBanned($user)): ?>
                    <div data-bs-toggle="tooltip" data-bs-placement="left" title="Sei stato bloccato">
                        <a class="btn btn-deepskyblue disabled" href="rating.php?course=<?php echo $courseId; ?>">Recensisci</a>
                    </div>
                <?php elseif ($dbh->canRateCourse($user, $courseId)[0]["existence"] && !$dbh->courseIsAlreadyRated($user, $courseId)): ?>
                    <a class="btn btn-deepskyblue" href="rating.php?course=<?php echo $courseId; ?>">Recensisci</a>
                <?php endif; ?>    
            </div>
        <?php endif; ?>
        
    </section>
</main>    
