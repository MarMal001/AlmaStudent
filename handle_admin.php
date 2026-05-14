<?php

require_once "init.php";

if (!isAdmin()) {
    header("location: /");
}

switch ($_POST["action"]) {
    case ADD_ACCOUNT:
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["type"])) {
            if ($_POST["type"] == "admin" || $_POST["type"] == "professor") {
                add_account($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["type"]);
            } else {
                $GLOBALS["message"] = "Tipo di account invalido";
            }
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    case ADD_COURSE:
        if (isset($_POST["degreeCode"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["semester"]) && isset($_POST["professors"]) && isset($_POST["courseId"])) {
            add_course($_POST["degreeCode"], $_POST["name"], $_POST["year"], $_POST["semester"], $_POST["professors"], $_POST["courseId"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    default:
        $GLOBALS["message"] = "Azione sconosciuta: " . $_POST["action"];
        break;
}

function add_account($username, $password, $name, $surname, $type) {
    if (isset($_POST["department"]) && isset($_POST["seat"]) && isset($_POST["infoReception"])) {
        $department = $_POST["department"];
        $seat = $_POST["seat"];
        $infoReception = $_POST["infoReception"];

        if (isset($_FILES["profilePicture"])) {
            $profilePicture = UPLOAD_DIR . "professor/" . $username . ".png";
            $f = fopen($profilePicture, "wb");
            fwrite($f, file_get_contents($_FILES["profilePicture"]["tmp_name"]));
        } else {
            $profilePicture = "default.png";
        }
    } else {
        $department = NULL;
        $seat = NULL;
        $infoReception = NULL;
        $profilePicture = NULL;
    }

    if ($GLOBALS["dbh"]->createAccout($username, $password, $name, $surname, $type, department: $department, seat: $seat, infoReception: $infoReception, profilePicture: $profilePicture)) {
        $GLOBALS["message"] = "Account aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere l'account";
    }
}

function add_course($degreeCode, $name, $year, $semester, $professors, $courseId) {
    if ($GLOBALS["dbh"]->addCourse($degreeCode, $name, $year, $semester, $professors, $courseId)) {
        $GLOBALS["message"] = "Corso aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso";
    }
}

header("location: admin_modify.php?message=" . $GLOBALS["message"]);

?>