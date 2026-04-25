<main> 
    <?php $student = "carla.anselmi3@studio.unibo.it"; ?> 
    <?php $professorId = $templateParams["professor"]; ?>
    <?php $professor = $dbh->getPersonInfo($professorId)[0]; ?>
    <h1><?php echo $professor["name"] . " " . $professor["surname"]; ?></h1>
    <section class="m-2">
        <div class="d-flex align-items-start">
            <h6 class="m-0 me-2">Rating degli studenti:</h6>
            <div>
                <?php $ratings = $dbh->getProfessorRatings($professorId)[0]; ?>
                <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
            </div>
        </div>
        <?php $profInfo = $dbh->getProfessorInfo($professorId)[0]; ?>
        <div class="card mb-3 bg-primary border-0 text-white" style="max-width: 600px;">
        <div class="row g-0">
                
            <div class="col-md-4 d-flex justify-content-center justify-content-md-start">
                <img src="<?php echo UPLOAD_DIR.'/professor/'.$profInfo["photo"]; ?>" class="img-fluid rounded-start object-fit-fill" alt="">
            </div>

            <div class="col-md-8">
            <div class="p-2">
                <p>
                <?php echo $profInfo["department"]; ?>
                </p>

                <button class="btn btn-light text-primary" type="button">Contatta il docente</a>
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
                <p class="m-0  p-2 text-start"><?php echo $course["courseName"]; ?></p>
                <div>
                    <?php $gRatings = $dbh->getGeneralRatingsByCourse($course["code"])[0]; ?>
                    <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                    <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
                </div>
                <?php if ($dbh->checkIfSubscribedToACourse($student, $course["code"])[0]["subscribed"]): ?>
                    <i class="fa-solid fa-check mx-2" style="color: rgb(38, 246, 30);"></i>
                <?php endif; ?>
            </div>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <div id="<?php echo $course["code"]; ?>" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <p>
            <?php echo $course["shortDescription"]; ?>
            </p>
            <div class="d-flex justify-content-end m-2">
                <button class="btn btn-primary me-1" type="button">Apri corso</button>
                <?php subscriptionButton($student, $course["code"]); ?>
            </div>
        </div>
        </div> 
        <?php endforeach; ?>   

    </section>

    <article>
        <h2>Ricevimento</h2>
        <p><?php echo $profInfo["infoReception"]; ?>
        </p>
    </article>
    <section>
        <h2>Opinioni degli studenti</h2>
        
        <div class="container-fluid text-white text-center">
            <div class="row"> 
            <div class="col-sm-2"></div>
            <div class="col-sm-6">
            <div class="list-group-item border-0">
                <div class="p-2 mb-3 rounded bg-light text-primary d-inline-block" style="max-width: 70%;">
                    <p>Ciao! Come va? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi cupiditate iusto natus.
                        Possimus deserunt quos inventore fugiat similique ducimus laboriosam aut eveniet, adipisci deleniti 
                        eligendi fugit. Ab quis officiis vitae?</p>
                </div>
            </div>
            <div class="list-group-item border-0 d-flex justify-content-end">
                <div class="p-2 mb-3 rounded bg-primary text-white" style="max-width: 70%;">
                    <p>Tutto bene, grazie! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi cupiditate iusto natus.
                        Possimus deserunt quos inventore fugiat similique ducimus laboriosam aut eveniet, adipisci deleniti 
                        eligendi fugit. Ab quis officiis vitae?</p>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
</main>    