<?php

require_once "init.php";

if (!isProfessor() || (isset($_GET["course"]) && !isDesignatedProfessor($user, $_GET["course"]))) {
    header("location: course.php?course=" . (isset($_GET["course"]) ? $_GET["course"] : ""));
}

if (isset($_GET["course"]) && isset($_POST["description"]) && isset($_POST["shortDescription"]) && isset($_POST["material"])) {
    if ($GLOBALS["dbh"]->updateCourseProfessor($_GET["course"], $_POST["description"], $_POST["shortDescription"], $_POST["material"])) {
        $message = "Aggiornato con successo";
    } else {
        $message = "Non è stato possibile aggiornare il corso";
    }
} else {
    $message = "Impossibile aggiornare il corso";
}

header("location: course.php?course=" . $_GET["course"] . "&message=" . $message);

?>
