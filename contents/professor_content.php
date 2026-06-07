<main class="p-5"> 
    <?php $professorId = $templateParams["professor"]; ?>
    <input type="hidden" id="professor" value=<?php echo $professorId;?> />
    <?php $professor = $dbh->getPersonInfo($professorId)[0]; ?>
    <h1><?php echo $professor["name"] . " " . $professor["surname"]; ?></h1>
    <section class="m-2 mb-4">
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
                <?php createStars(getMeanRating($ratings), "#154388"); ?>
            </div>
        </div>
        <?php $profInfo = $dbh->getProfessorInfo($professorId)[0]; ?>
        <div class="card mt-2 mb-3 bg-deepskyblue border-0 text-white" style="max-width: 600px;">
        <div class="row g-0">
                
            <div class="col-md-4 d-flex justify-content-center justify-content-md-start">
                <img src="<?php echo UPLOAD_DIR.'/professor/'.$profInfo["photo"]; ?>" class="img-fluid rounded-start object-fit-fill" alt="">
            </div>

            <div class="col-md-8">
            <div class="p-2">
                <p class="m-3 me-4">
                <?php echo $profInfo["department"]; ?>
                </p>
                <p></p>
            </div>
            </div>
        </div>
        </div>

        <?php if ($user == $professorId): ?>
            <a href="update_profile_professor.php?professor=<?php echo idWithoutDomain($professorId); ?>" class="btn btn-deepskyblue">Modifica informazioni profilo</a>
        <?php endif; ?>

    </section>
    <section>
        <h2 class="mb-4">Corsi</h2>
        <?php $courses = $dbh->getCoursesByProfessor($professorId); ?>
        <?php foreach($courses as $course): ?>
        <div class="container-fluid w-auto w-lg-55 m-2 ms-3 p-0">
            <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-100">
                <div class="d-flex justify-content-between align-items-center text-darkbluenavy fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
                    <div class="d-md-inline-flex align-items-md-center p-0">
                        <p class="m-0 p-2 text-start"><?php echo $course["name"]; ?></p>
                        <div>
                            <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                            <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                            <?php createStars(getMeanRating($ratings), "#154388"); ?>
                        </div>
                        <?php if ($dbh->checkIfSubscribedToACourse($user, $course["code"])): ?>
                            <i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>
                        <?php endif; ?>
                    </div>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </div>
                <div id="<?php echo $course["code"]; ?>" class="collapse p-3">
                    <p>
                    <?php echo $course["shortDescription"]; ?>
                    </p>
                    <div class="d-flex justify-content-end">
                        <a href="course.php?course=<?php echo $course["code"]; ?>" class="btn btn-deepskyblue me-1 mt-2">Apri corso</a>
                        <?php
                            if (isStudent())
                                subscriptionButton($user, $course["code"], $professorId);
                        ?>
                    </div>
                </div>
            </div>
        </div> 
        <?php endforeach; ?>   

    </section>

    <article class="mt-4">
        <h2>Ricevimento</h2>
        <p><?php echo $profInfo["infoReception"]; ?></p>
        <div class="d-flex justify-content-center">
            <table class="table table-bordered" id="receptionTable">
            </table>
        </div>
        <?php if ($user == $professorId): ?>
            <a href="reception_editable.php" class="btn btn-deepskyblue">Modifica Disponibilità</a>
        <?php endif; ?>
    </article>
    <section class="mt-3">
        <h2>Opinioni degli studenti</h2>

        <?php $reviews = $dbh->getReviewsByProfessor($professorId); 
            $noReviews = false;
            $style = "";
            if ($reviews == NULL) {
                $style = "d-flex justify-content-center align-items-center";
                $noReviews = true;
            } 
        ?>
        
            <div class="card mb-3 mt-4">
                <div class="card-body overflow-auto bg-light-subtle <?php echo $style; ?>">
                    <?php if ($noReviews): ?>
                        <h5 class="text-center text-secondary fw-normal">Non è presente ancora nessuna recensione</h5>
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
