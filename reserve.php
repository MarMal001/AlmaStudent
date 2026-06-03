<?php

require_once "init.php";

if (!isStudent() || $dbh->isStudentBanned($user) || !isset($_GET["type"])) {
    header("location: index.php");
    exit();
}

if (!isset($_GET["start"]) || !isset($_GET["date"]) || !isset($_GET["professor"])) {
    header("location: professor.php?professor=" . $_GET["professor"] . "&message=Parametri mancanti");
    exit();
}

if ($_GET["type"] == "reserve") {
    if (isset($_GET["mode"])) {
        if ($dbh->reserveSlot($_GET["start"], $_GET["date"], $_GET["professor"] . "@unibo.it", $user, $_GET["mode"])) {
            $message = "Prenotato con successo";
        } else {
            $message = "Non è stato possibile prenotare";
        }
    } else {
        $message = "Parametri mancanti";
    }
} else if ($_GET["type"] == "unreserve") {
    if ($dbh->cancelReservedSlot($_GET["start"], $_GET["date"], $_GET["professor"] . "@unibo.it")) {
        $message = "Prenotazione cancellata con successo";
    } else {
        $message = "Non è stato possibile cancellare la prenotazione";
    }
} else {
    $message = "Tipo di modalità invalida";
}

header("location: professor.php?professor=" . $_GET["professor"] . "&message=" . $message);
