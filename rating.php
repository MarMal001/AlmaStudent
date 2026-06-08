<?php
require_once "init.php";

$templateParams["title"] = "Rating";
$templateParams["content"] = "rating_content.php";
$templateParams["style"] = ["style.css"];

if(!isStudent() || $dbh->isStudentBanned($user)) {
    header("location: index.php");
    exit();
} else {
    if (isset($_GET["course"]) && $dbh->courseExists($_GET["course"])) {
        if ($dbh->canRateCourse($user, $_GET["course"])[0]["existence"] && !$dbh->courseIsAlreadyRated($user, $_GET["course"])) {
            $templateParams["course"] = $_GET["course"];
        } elseif ($dbh->courseExists($_GET["course"])) {
            $message = "Il corso indicato non esiste";
            $messageType = "warning";
            header("location: index.php");
        } else {
            $message = "Non puoi recensire questo corso in questo momento";
            $messageType = "danger";
            header("location: index.php");
        }
    } else {
        $message = "Parametri mancanti";
        $messageType = "warning";
        header("location: index.php");
    }
}

require "template/base.php";
?>
