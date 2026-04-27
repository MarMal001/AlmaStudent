<main>
    <?php $courseId = $templateParams["course"]; ?>
    <?php $courseInfo = $dbh->getCourseInfo($courseId)[0]; ?>  
    <?php $professors = $dbh->getProfessorsByCourse($courseId); ?>
    <?php $student = "carla.anselmi3@studio.unibo.it"; ?>
    <h1><?php echo $courseInfo["name"]; ?></h1>
    <section>
        <h3>
            <?php foreach($professors as $professor): ?>
                <a href="professor.php?professor=<?php echo $professor["professor"]; ?>" class="text-primary"><?php echo $professor["name"] . " " . $professor["surname"]; ?></a>
            <?php endforeach; ?>
        </h3>
        <div class="d-flex align-items-start">
            <h6 class="m-0 me-2">Rating degli studenti:</h6>
            <div>
                <?php $gRatings = $dbh->getGeneralRatingsByCourse($courseId)[0]; ?>
                <?php $ratings = [$gRatings["ratingL"], $gRatings["ratingM"], $gRatings["ratingE"], $gRatings["ratingD"]]; ?>
                <?php createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
            </div>
        </div>
        <div class="mb-3">
            <?php subscriptionButton($student, $courseId); ?>
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

        <div class="card" style="height: clamp(200px, 60vh, 600px);">
            <div class="card-body overflow-auto">
                <p>Testo molto lungo... Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum illo ratione officia enim eligendi possimus labore. Eius quae sapiente dignissimos, nulla, optio hic molestiae explicabo in magnam, sequi iusto culpa?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ullam reprehenderit. Ipsam eius voluptatem rem? Cumque mollitia saepe dolor aut obcaecati dolore. Facere quo veniam ullam excepturi quis iste doloremque?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere non odit sequi maxime a suscipit consectetur accusamus dignissimos sint veniam, reprehenderit sapiente quisquam velit incidunt ea ratione quaerat cum veritatis? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam alias, voluptates labore omnis quidem odit accusamus? Adipisci dolores quidem assumenda ad nobis, exercitationem aspernatur non incidunt asperiores, explicabo animi error. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis ullam blanditiis necessitatibus eius voluptas neque iure in fugit dolor! Amet deserunt obcaecati illum ratione ex adipisci, voluptas repudiandae aperiam doloribus.</p>
            </div>
        </div>
        
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