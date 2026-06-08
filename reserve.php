<?php

require_once "init.php";

if (!isStudent() || $dbh->isStudentBanned($user) || !isset($_GET["type"])) {
    header("location: index.php");
    exit();
}

if (!isset($_GET["start"]) || !isset($_GET["date"]) || !isset($_GET["professor"])) {
    header("location: professor.php?professor=" . $_GET["professor"]);
    $_SESSION["message"] = "Parametri mancanti";
    $_SESSION["messageType"] = "warning";
    exit();
}

if ($_GET["type"] == "reserve") {
    if (isset($_GET["mode"])) {
        if ($dbh->reserveSlot($_GET["start"], $_GET["date"], $_GET["professor"] . "@unibo.it", $user, $_GET["mode"])) {
            $message = "Prenotato con successo";
            $messageType = "success";
        } else {
            $message = "Non è stato possibile prenotare";
            $messageType = "danger";
        }
    } else {
        $message = "Parametri mancanti";
        $messageType = "warning";
    }
} else if ($_GET["type"] == "unreserve") {
    if ($dbh->cancelReservedSlot($_GET["start"], $_GET["date"], $_GET["professor"] . "@unibo.it")) {
        $message = "Prenotazione cancellata con successo";
        $messageType = "success";
    } else {
        $message = "Non è stato possibile cancellare la prenotazione";
        $messageType = "danger";
    }
} else {
    $message = "Tipo di modalità invalida";
    $messageType = "warning";
}

$_SESSION["message"] = $message;
$_SESSION["messageType"] = $messageType;
header("location: professor.php?professor=" . $_GET["professor"]);
