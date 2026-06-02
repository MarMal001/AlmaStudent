<main> 
    <?php $professorId = $templateParams["professor"]; ?>
    <?php $professor = $dbh->getPersonInfo($professorId)[0]; ?>
    <?php $date = "2026-04-12";//date("Y-M-d"); ?>
    <h1><?php echo $professor["name"] . " " . $professor["surname"]; ?></h1>
    <section class="m-2">
        <div class="d-flex align-items-start align-items-center">
            <h6 class="m-0 me-2">Rating degli studenti:</h6>
            <?php $ratings = $dbh->getProfessorRatings($professorId)[0]; ?>
            <div data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Disponibilità:</p>
                    <?php createStars($ratings["ratingD"], "#ffff"); ?>
                </div>
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Comprensibilità:</p>
                    <?php createStars($ratings["ratingC"], "#ffff"); ?>
                </div>
                <div class='d-flex inline-flex align-items-center'>
                    <p class='mb-0 me-2'>Interesse:</p>
                    <?php createStars($ratings["ratingI"], "#ffff"); ?>
                </div>
            ">
                <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
            </div>
        </div>
        <?php $profInfo = $dbh->getProfessorInfo($professorId)[0]; ?>
        <div class="card mt-2 mb-3 bg-primary border-0 text-white" style="max-width: 600px;">
        <div class="row g-0">
                
            <div class="col-md-4 d-flex justify-content-center justify-content-md-start">
                <img src="<?php echo UPLOAD_DIR.'/professor/'.$profInfo["photo"]; ?>" class="img-fluid rounded-start object-fit-fill" alt="">
            </div>

            <div class="col-md-8">
            <div class="p-2">
                <p>
                <?php echo $profInfo["department"]; ?>
                </p>
                <?php if (isProfessor()): ?>
                    <a href=# class="btn btn-light text-primary">Modifica foto profilo</a>
                <?php endif; ?>
            </div>
            </div>

        </div>
        </div>


    </section>
    <section>
        <h2>Corsi</h2>
        <?php $courses = $dbh->getCoursesByProfessor($professorId); ?>
        <?php foreach($courses as $course): ?>
        <div class="container-fluid w-auto w-lg-55 m-2 p-0">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
            <div class="d-md-inline-flex align-items-md-center p-0">
                <p class="m-0  p-2 text-start"><?php echo $course["name"]; ?></p>
                <div>
                    <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                    <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                    <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
                </div>
                <?php if ($dbh->checkIfSubscribedToACourse($user, $course["code"])): ?>
                    <i class="fa-solid fa-check mx-2" style="color: rgb(38, 246, 30);"></i>
                <?php endif; ?>
            </div>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <div id="<?php echo $course["code"]; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <p>
            <?php echo $course["shortDescription"]; ?>
            </p>
            <div class="d-flex justify-content-end">
                <a href="course.php?course=<?php echo $course["code"]; ?>" class="btn btn-primary me-1 mt-2">Apri corso</a>
                <?php
                    if (isStudent())
                        subscriptionButton($user, $course["code"], $professorId);
                ?>
            </div>
        </div>
        </div> 
        <?php endforeach; ?>   

    </section>

    <article>
        <h2>Ricevimento</h2>
        <p><?php echo $profInfo["infoReception"]; ?></p>
        <table class="table table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th id="day" scope="colgroup" colspan="3" class="fs-5"> < <?php echo $date; ?> ></th>
                </tr>
                <tr class="fs-6">
                    <th id="time" scope="col">Ore</th>
                    <th id="type" scope="col">Disponibilità</th>
                    <th id="reservations" scope="col">Prenotazioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dbh->getReservationsOfProfessor($professorId, $date) as $reservation): ?>
                    <?php $timeRange = date("H:i", strtotime($reservation["startTime"])) . " - " . date("H:i", strtotime($reservation["endTime"])); ?>
                    <tr>
                        <th id="<?php echo $timeRange; ?>" scope="row" headers="time" class="text-center"><div><?php echo $timeRange; ?></div></th>
                        <td id="<?php echo "type_" . $timeRange; ?>" headers="type <?php echo $timeRange; ?>"><div>Modalità: <?php echo strtolower($reservation["mode"]); ?></div></td>
                        <td id="<?php echo "availability_" . $timeRange; ?>"><a href="reserve.php?start=<?php echo $reservation["startTime"]; ?>&professor=<?php echo $professorId ?>" class="btn btn-primary" <?php echo $reservation["name"] != NULL ? "disabled" : "" ?>>Prenota</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
    <section>
        <h2>Opinioni degli studenti</h2>

        <?php $reviews = $dbh->getReviewsByProfessor($professorId); 
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
                        generateProfessorReview($page[2], $review["id"], $review["student"], $review["date"], $review["text"], $review["reported"], $professorId, $review["course"]); ?>
                <?php endforeach; ?>
            </div>
        </div>
        
    </section>
</main>
