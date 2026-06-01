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
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci le segnalazioni, i corsi e i professori dell'ateneo.</div>
</section>
<section>
    <a href="admin_modify.php?type=handleDegrees" class="btn btn-primary">Modifica le facoltà</a>
    <a href="admin_modify.php?type=addCourse" class="btn btn-primary">Aggiungi corso</a>
    <a href="admin_modify.php?type=addAccount&accountType=professor" class="btn btn-primary">Aggiungi account professore</a>
    <a href="admin_modify.php?type=addAccount&accountType=admin" class="btn btn-primary">Aggiungi account admin</a>
</section>
<section class="fw-bold">
    <h1>Segnalazioni da risolvere</h1>
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


<script> //TODO --> move into a js file
  document.addEventListener("DOMContentLoaded", function () {
    const toastEl = document.querySelector('.toast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  });
</script>
