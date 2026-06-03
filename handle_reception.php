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
            break;
        }
    }
}

function addReception($startTimeSlot, $endTimeSlot) {
    if (isset($_POST["mode"])) {
        if ($GLOBALS["dbh"]->addAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $endTimeSlot, $_POST["mode"])) {
            $GLOBALS["message"] = "Aggiunto con successo";
        } else {
            $GLOBALS["message"] = "Non è stato possibile aggiungere";
        }
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere";
    }
}

function modifyReception($startTimeSlot) {
    if (isset($_POST["mode"])) {
        if ($GLOBALS["dbh"]->updateAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $_POST["mode"])) {
            $GLOBALS["message"] = "Modificato con successo";
        } else {
            $GLOBALS["message"] = "Non è stato possibile modificare";
        }
    } else {
        $GLOBALS["message"] = "Non è stato possibile modificare";
    }
}

function deleteReception($startTimeSlot) {
    if ($GLOBALS["dbh"]->removeAvailabilityOfProfessor($_SESSION["username"], $_POST["receptionDate"], $startTimeSlot, $_POST["mode"])) {
        $GLOBALS["message"] = "Rimosso con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile rimuovere";
    }
}

header("location: reception_editable.php?message=" . $GLOBALS["message"]);

?>
