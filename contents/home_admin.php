<section>
    <?php if (isset($_SESSION["message"])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">   
            <div class="toast align-items-center text-bg-primary border-0" role="alert">
                <div class="d-flex">
                <div class="toast-body">
                    <?php 
                    echo $_SESSION["message"]; 
                    unset($_SESSION["message"])
                    ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php $userData = $dbh->getPersonInfo($user)[0]; ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci le segnalazioni, i corsi e i professori dell'ateneo.</div>
</section>
<section>
    <a href="admin_modify.php?type=handleDegrees" class="btn btn-primary">Modifica le facoltà</a>
    <a href="admin_modify.php?type=handleCourse" class="btn btn-primary">Modifica corsi</a>
    <a href="admin_modify.php?type=handleAccount&accountType=DOCENTE" class="btn btn-primary">Modifica account docenti</a>
    <a href="admin_modify.php?type=handleAccount&accountType=ADMIN" class="btn btn-primary">Modifica account admin</a>
</section>
<section class="fw-bold">
    <h2>Segnalazioni da risolvere</h2>
    <?php $reportedReviewsProf = $dbh->getReportedReviewsOfProfessors(); ?>
    <?php $reportedReviewsCourses = $dbh->getReportedReviewsOfCourses(); ?>
    <ul>
        <?php foreach ($reportedReviewsProf as $reportedReviewProf): ?>
        <li><a class="text-start link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="report_handling.php?id=<?php echo $reportedReviewProf["id"]; ?>&type=professor"><?php echo $reportedReviewProf["student"] . " segnalazione per la recensione di " . $reportedReviewProf["profName"] . " " . $reportedReviewProf["profSurname"] . " - " . date("d/m/Y", strtotime($reportedReviewProf["date"])) ?></a></li>
    <?php endforeach; ?>
    <?php foreach ($reportedReviewsCourses as $reportedReviewCourse): ?>
       <li><a class="text-start link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="report_handling.php?id=<?php echo $reportedReviewCourse["id"]; ?>&type=course"><?php echo $reportedReviewCourse["student"] . " segnalazione per la recensione di " . $reportedReviewCourse["courseName"] . " " .$reportedReviewCourse["courseId"] . " - " . date("d/m/Y", strtotime($reportedReviewCourse["date"])) ?></a></li>
    <?php endforeach; ?>
    </ul>
    <?php if($reportedReviewsCourses == NULL && $reportedReviewsProf == NULL): ?>
        <p>Non sono presenti segnalazioni</p>
    <?php endif; ?>
</section>
