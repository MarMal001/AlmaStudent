<section class="mx-5 mt-5 mb-3">
    <?php $userData = $dbh->getPersonInfo($user)[0]; ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci le segnalazioni, i corsi e i professori dell'ateneo.</div>
</section>
<section class="d-flex flex-column flex-lg-row align-items-start mx-5">
    <a href="admin_modify.php?type=handleDegrees" class="btn btn-deepskyblue m-1 p-3">Gestisci le facoltà</a>
    <a href="admin_modify.php?type=handleCourse" class="btn btn-deepskyblue m-1 p-3">Gestisci corsi</a>
    <a href="admin_modify.php?type=handleAccount&accountType=DOCENTE" class="btn btn-deepskyblue m-1 p-3">Gestisci account docenti</a>
    <a href="admin_modify.php?type=handleAccount&accountType=ADMIN" class="btn btn-deepskyblue m-1 p-3">Gestisci account admin</a>
</section>
<section class="fw-bold mb-5 mx-5 mt-4">
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
