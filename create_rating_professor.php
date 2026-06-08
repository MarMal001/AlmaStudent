<?php 
require_once "init.php";

foreach ($dbh->getProfessorsByCourse($_POST["course"]) as $professor) {
    $professorId = str_replace('.', '_', $professor["professor"]);
    $code = $dbh->createProfessorRating($professor["professor"], $user, $_POST["course"], $_POST["ratingD" . $professorId], $_POST["ratingC" . $professorId], $_POST["ratingI" . $professorId]);
    if (isset($_POST["review" . $professorId]) && $_POST["review" . $professorId] != "") {
        $dbh->createReview($code, $_POST["review" . $professorId]);
    }
    $dbh->updateGeneralCourseRatingProfAvailability($_POST["course"]);
    $_SESSION["message"] = "Recensione avvenuta con successo";
    $_SESSION["messageType"] = "success";
    header("location: index.php");
}
