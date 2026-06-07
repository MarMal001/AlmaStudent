<main>
    <?php $courseId = $templateParams["course"]; ?>
    <?php $courseInfo = $dbh->getCourseInfo($courseId)[0]; ?>  
    <?php $professors = $dbh->getProfessorsByCourse($courseId); ?>
    <h1><?php echo $courseInfo["name"]; ?></h1>
    <section>
        <h3>
            <?php foreach($professors as $professor): ?>
                <a href="professor.php?professor=<?php echo idWithoutDomain($professor["professor"]); ?>" class="text-primary"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a>
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
        <div class="mb-3">
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
    <article>
        <h2>Descrizione</h2>
        <p>
            <?php echo $courseInfo["description"]; ?>
        </p>
    </article>
    <article>
        <h2>Materiale</h2>
        <p>
            <?php echo $courseInfo["material"]; ?>
        </p>
    </article>
    <section>
        <h2>Opinioni degli studenti</h2>

        <?php $reviews = $dbh->getReviewsByCourse($courseId);
            $noReviews = false;
            $style = "";
            if ($reviews == NULL) {
                    $style = "d-flex justify-content-center align-items-center";
                    $noReviews = true;
            } 
        ?>

        <div class="card mb-3" style="height: clamp(200px, 60vh, 300px);">
            <div class="card-body overflow-auto bg-light <?php echo $style; ?>">
                <?php if ($noReviews): ?>
                    <h4 class="text-center">Non è presente ancora nessuna recensione</h4>
                <?php endif; ?>
                <?php foreach ($reviews as $review): ?>
                    <?php 
                        $page = explode("/", $_SERVER['REQUEST_URI']);
                        generateCourseReview($page[2], $review["id"], $review["student"], $review["date"], $review["text"], $review["reported"], $courseId); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (isStudent()): ?>
            <div class="d-flex justify-content-end mb-5 me-2">
                <?php if (!$dbh->canRateCourse($user, $courseId)[0]["existence"] || $dbh->courseIsAlreadyRated($user, $courseId) || $dbh->isStudentBanned($user)): ?>
                    <div data-bs-toggle="tooltip" data-bs-placement="left" title="Non hai ancora sostenuto con esito positivo l'esame o hai già recensito o sei stato bloccato">
                        <a class="btn btn-deepskyblue disabled" href="rating.php?course=<?php echo $courseId; ?>">Recensisci</a>
                    </div>
                <?php else: ?>
                    <a class="btn btn-deepskyblue" href="rating.php?course=<?php echo $courseId; ?>">Recensisci</a>
                <?php endif; ?>    
            </div>
        <?php endif; ?>
        
    </section>
</main>    
