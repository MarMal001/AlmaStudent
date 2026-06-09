<main class="p-5">
    <?php 
        $professorId = $templateParams["professor"]; 
        $page = explode("/", $_SERVER['REQUEST_URI'])[2];
    ?>
    <input type="hidden" id="professor" value=<?php echo $professorId;?> />
    <input type="hidden" id="url" value=<?php echo $page;?> />
    <input type="hidden" id="type" value="professor" />
    <?php $professor = $dbh->getPersonInfo($professorId)[0]; ?>
    <div class="mb-3"><?php showMessage(); ?></div>
    <h1><?php echo $professor["name"] . " " . $professor["surname"]; ?></h1>
    <div class="m-2 mb-4">
        <div class="d-flex align-items-start">
            <p class="m-0 me-2 fs-6">Rating degli studenti:</p>
            <?php $ratings = $dbh->getProfessorRatings($professorId)[0]; ?>
            <div role="button" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="
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
        <div class="card mt-2 mb-3 bg-deepskyblue border-0 text-white">
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

    </div>
    <section>
        <h2 class="mb-3 mt-4">Corsi</h2>
        <?php $courses = $dbh->getCoursesByProfessor($professorId); ?>
        <?php foreach($courses as $course): ?>
        <div class="container-fluid w-auto w-lg-55 m-2 ms-3 p-0">
            <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-100 p-0">
                <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between text-darkbluenavy align-items-center fw-bold p-4" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $course["code"]; ?>">
                    <span class="d-md-inline-flex align-items-md-center ps-2">
                        <?php echo $course["name"]; ?>
                        <span class="ms-md-2">
                            <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                            <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                            <?php createStars(getMeanRating($ratings), "#154388"); ?>
                        </span>
                        <?php if ($dbh->checkIfSubscribedToACourse($user, $course["code"])): ?>
                            <i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>
                        <?php endif; ?>
                    </span>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </button>
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
        <p class="mt-3 pt-0"><?php echo $profInfo["infoReception"]; ?></p>
        <div class="d-flex justify-content-center">
            <table class="table table-bordered" id="receptionTable">
            </table>
        </div>
        <div class="d-flex justify-content-end me-5 pe-4">
            <?php if ($user == $professorId): ?>
                <a href="reception_editable.php" class="btn btn-deepskyblue">Modifica Disponibilità</a>
            <?php endif; ?>
        </div>
    </article>
    <section class="mt-4">
        <h2>Opinioni degli studenti</h2>
        <div class="d-inline-flex ms-3 mt-2">
            <label for="reviewsNumber" class="mt-2">Visualizza: </label>
            <select name="reviewsNumber" id="reviewsNumber" class="rounded-pill form-select ms-2" onChange="getSelectedProfessorReviewsForm()">
                <option value="" selected>Tutte</option>
                <option value="5">ultime 5</option>
                <option value="10">ultime 10</option>
                <option value="50">ultime 50</option>
            </select>
        </div>

        <?php $reviews = $dbh->getReviewsByProfessor($professorId); 
            $noReviews = false;
            $style = "";
            if ($reviews == NULL) {
                $style = "d-flex justify-content-center align-items-center";
                $noReviews = true;
            }
        ?>
        
        <div class="card mb-3 mt-3 mx-3">
            <div class="card-body overflow-auto bg-light-subtle <?php echo $style; ?>" id="profReviews">
            </div>
        </div>
    </section>
</main>
