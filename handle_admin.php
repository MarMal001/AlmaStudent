<?php

require_once "init.php";

if (!isAdmin() || !isset($_POST["action"])) {
    header("location: /");
}

switch ($_POST["action"]) {
    case ADMIN_ADD_ACCOUNT:
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
    case ADMIN_ADD_COURSE:
        if (isset($_POST["degreeCode"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["semester"]) && isset($_POST["professors"]) && isset($_POST["courseId"])) {
            add_course($_POST["degreeCode"], $_POST["name"], $_POST["year"], $_POST["semester"], $_POST["professors"], $_POST["courseId"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    case ADMIN_ADD_DEGREE:
        if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["years"]) && isset($_POST["department"]) && isset($_POST["branch"])) {
            add_degree($_POST["code"], $_POST["name"], $_POST["department"], $_POST["years"], $_POST["branch"]);
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
    if ($GLOBALS["dbh"]->addCourse($courseId, $name, $degreeCode, $year, $semester, $professors)) {
        $GLOBALS["message"] = "Corso aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso";
    }
}

function add_degree($code, $name, $department, $years, $branch) {
    if ($GLOBALS["dbh"]->addDegree($code, $name, $department, $years, $branch)) {
        $GLOBALS["message"] = "Corso di laurea aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso di laurea";
    }
}

header("location: admin_modify.php?message=" . $GLOBALS["message"]);

?>