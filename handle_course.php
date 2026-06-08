<?php

require_once "init.php";

if (!isProfessor() || (isset($_GET["course"]) && !isDesignatedProfessor($user, $_GET["course"]))) {
    header("location: course.php?course=" . (isset($_GET["course"]) ? $_GET["course"] : ""));
    $message = "Parametri mancanti";
    $messageType = "warning";
    exit();
}

if (isset($_GET["course"]) && isset($_POST["description"]) && isset($_POST["shortDescription"]) && isset($_POST["material"])) {
    if ($dbh->updateCourseProfessor($_GET["course"], $_POST["description"], $_POST["shortDescription"], $_POST["material"])) {
        $message = "Aggiornato con successo";
        $messageType = "success";
    } else {
        $message = "Non è stato possibile aggiornare il corso";
        $messageType = "danger";
    }
} else {
    $message = "Parametri mancanti";
    $messageType = "warning";
}

$_SESSION["message"] = $message;
$_SESSION["messageType"] = $messageType;

header("location: course.php?course=" . $_GET["course"]);

?>
