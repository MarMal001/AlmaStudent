<?php

require_once "init.php";

if (!isProfessor()) {
    header("location: course.php");
    exit();
}

define("ONE_MINUTE_IN_SECONDS", 60);
define("ONE_QUARTER_OF_HOUR", 15);

if (isset($_POST["receptionDate"]) && isset($_POST["startTimeHour"]) && isset($_POST["startTimeMinute"]) && isset($_POST["endTimeHour"]) && isset($_POST["endTimeMinute"])) {
    $startTime = mktime($_POST["startTimeHour"], $_POST["startTimeMinute"], 0, 0, 0, 0);
    $endTime = mktime($_POST["endTimeHour"], $_POST["endTimeMinute"], 0, 0, 0, 0);

    $diffTime = ($endTime - $startTime) / ONE_MINUTE_IN_SECONDS; # Get minutes 
    for ($i = 0; $i < $diffTime; $i += ONE_QUARTER_OF_HOUR) {
        $startTimeSlot = $startTime + $i * ONE_MINUTE_IN_SECONDS;
        $endTimeSlot = $startTime + ($i + ONE_QUARTER_OF_HOUR) * ONE_MINUTE_IN_SECONDS;
        switch ($_POST["action"]) {
        case RECEPTION_ACTION_ADD:
            addReception(date("H:i", $startTimeSlot), date("H:i", $endTimeSlot));
            break;
        case RECEPTION_ACTION_MODIFY:
            modifyReception(date("H:i", $startTimeSlot));
            break;
        case RECEPTION_ACTION_DELETE:
            deleteReception(date("H:i", $startTimeSlot));
            break;
        default:
            $GLOBALS["message"] = "Azione sconosciuta: " . $_POST["action"];
            $GLOBALS["messageType"] = "warning";
            break;
        }
    }
}

function addReception($startTimeSlot, $endTimeSlot) {
    if (isset($_POST["mode"])) {
        if ($GLOBALS["dbh"]->addAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $endTimeSlot, $_POST["mode"])) {
            $GLOBALS["message"] = "Aggiunta disponibilità con successo";
            $GLOBALS["messageType"] = "success";
        } else {
            $GLOBALS["message"] = "Non è stato possibile aggiungere la disponibilità";
            $GLOBALS["messageType"] = "danger";
        }
    } else {
        $GLOBALS["message"] = "Parametri mancanti";
        $GLOBALS["messageType"] = "warning";
    }
}

function modifyReception($startTimeSlot) {
    if (isset($_POST["mode"])) {
        if ($GLOBALS["dbh"]->updateAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $_POST["mode"])) {
            $GLOBALS["message"] = "Modificata disponibilità con successo";
            $GLOBALS["messageType"] = "success";
        } else {
            $GLOBALS["message"] = "Non è stato possibile modificare la disponibilità";
            $GLOBALS["messageType"] = "danger";
        }
    } else {
        $GLOBALS["message"] = "Parametri mancanti";
        $GLOBALS["messageType"] = "warning";
    }
}

function deleteReception($startTimeSlot) {
    if ($GLOBALS["dbh"]->removeAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $_POST["mode"])) {
        $GLOBALS["message"] = "Rimossa disponibilità con successo";
        $GLOBALS["messageType"] = "success";
    } else {
        $GLOBALS["message"] = "Non è stato possibile rimuovere la disponibilità";
        $GLOBALS["messageType"] = "danger";
    }
}

$_SESSION["message"] = $GLOBALS["message"];
$_SESSION["messageType"] = $GLOBALS["messageType"];

header("location: reception_editable.php");

?>
