<?php

require_once("init.php");

if (!isProfessor()) {
    header("location: index.php");
    exit();
}

if (isset($_POST["department"]) && isset($_POST["seat"]) && isset($_POST["infoReception"])) {
    if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["name"] != "") {
        $profilePicture = idWithoutDomain($user) . ".jpg";
        $f = fopen(UPLOAD_DIR . "/professor/" . $profilePicture, "wb");
        fwrite($f, file_get_contents($_FILES["profilePicture"]["tmp_name"]));
    } else {
        $profilePicture = NULL;
    }

    $professorInfo = $dbh->getProfessorInfo($user)[0];
    if ($dbh->updateAccount($user, $professorInfo["name"], $professorInfo["surname"], "DOCENTE", $_POST["department"], $_POST["seat"], $_POST["infoReception"], $profilePicture)) {
        $message = "Descrizione modificata con successo";
        $messageType = "success";
    } else {
        $message = "Non è stato possibile modificare la descrizione";
        $messageType = "danger";
    }
} else {
    $message = "Parametri mancanti";
    $messageType = "warning";
}

$_SESSION["message"] = $message;
$_SESSION["messageType"] = $messageType;

header("location: professor.php?professor=" . idWithoutDomain($user));
