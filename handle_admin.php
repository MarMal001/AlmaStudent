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
    case ADMIN_MODIFY_ACCOUNT:
        if (isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["type"])) {
            if ($_POST["type"] == "professor" || $_POST["type"] == "admin") {
                update_account($_POST["username"], $_POST["name"], $_POST["surname"], $_POST["type"]);
            } else {
                $GLOBALS["message"] = "Tipo di account invalido";
            }
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    case ADMIN_DELETE_ACCOUNT:
        if (isset($_POST["username"]) && isset($_POST["type"])) {
            delete_account($_POST["username"], $_POST["type"]);
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
    // case ADMIN_MODIFY_COURSE:
    //     if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["semester"]) && isset($_POST["professors"])) {
    //         update_course($_POST["code"], $_POST["name"], $_POST["year"], $_POST["semester"], $_POST["professors"]);
    //     } else {
    //         $GLOBALS["message"] = "Parametri mancanti";
    //     }
    //     break;
    case ADMIN_DELETE_COURSE:
        if (isset($_POST["code"])) {
            delete_course($_POST["code"]);
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
    // case ADMIN_MODIFY_DEGREE:
    //     if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["nYears"]) && isset($_POST["campus"])) {
    //         update_degree($_POST["code"], $_POST["name"], $_POST["nYears"], $_POST["campus"]);
    //     } else {
    //         $GLOBALS["message"] = "Parametri mancanti";
    //     }
    //     break;
    case ADMIN_DELETE_DEGREE:
        if (isset($_POST["code"])) {
            delete_degree($_POST["code"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    default:
        $GLOBALS["message"] = "Azione sconosciuta: " . $_POST["action"];
        break;
}

function add_account($username, $password, $name, $surname, $type) {
    $department = isset($_POST["department"]) ? $_POST["department"] : NULL;
    $seat = isset($_POST["seat"]) ? $_POST["seat"] : NULL;
    $infoReception = isset($_POST["infoReception"]) ? $_POST["infoReception"] : NULL;

    if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["name"] != "") {
        $profilePicture = idWithoutDomain($username) . ".png";
        $f = fopen(UPLOAD_DIR . "/professor/" . $profilePicture, "wb");
        fwrite($f, file_get_contents($_FILES["profilePicture"]["tmp_name"]));
    } else {
        $profilePicture = "default.png";
    }

    if ($GLOBALS["dbh"]->createAccout($username, $password, $name, $surname, $type, department: $department, seat: $seat, infoReception: $infoReception, profilePicture: $profilePicture)) {
        $GLOBALS["message"] = "Account aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere l'account";
    }
}

function update_account($username, $name, $surname, $removeProfilePicture = false) {
    $department = isset($_POST["department"]) ? $_POST["department"] : NULL;
    $seat = isset($_POST["seat"]) ? $_POST["seat"] : NULL;
    $infoReception = isset($_POST["infoReception"]) ? $_POST["infoReception"] : NULL;
    $profilePicture = $removeProfilePicture ? "default.png" : NULL;

    if ($GLOBALS["dbh"]->updateAccout($username, $name, $surname, $department, $seat, $infoReception, $profilePicture)) {
        $GLOBALS["message"] = "Account modificato con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile modificare l'account";
    }
}

function delete_account($username, $type) {
    if ($GLOBALS["dbh"]->deleteAccount($username, $type)) {
        $GLOBALS["message"] = "Account eliminato con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile eliminare l'account";
    }
}

function add_course($degreeCode, $name, $year, $semester, $professors, $courseId) {
    if ($GLOBALS["dbh"]->addCourse($courseId, $name, $degreeCode, $year, $semester, $professors)) {
        $GLOBALS["message"] = "Corso aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso";
    }
}

function delete_course($username) {
    if ($GLOBALS["dbh"]->deleteCourse($username)) {
        $GLOBALS["message"] = "Account eliminato con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile eliminare l'account";
    }
}

function add_degree($code, $name, $department, $years, $branch) {
    if ($GLOBALS["dbh"]->addDegree($code, $name, $department, $years, $branch)) {
        $GLOBALS["message"] = "Corso di laurea aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso di laurea";
    }
}

function delete_degree($username) {
    if ($GLOBALS["dbh"]->deleteDegree($username)) {
        $GLOBALS["message"] = "Account eliminato con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile eliminare l'account";
    }
}

header("location: admin_modify.php?message=" . $GLOBALS["message"]);

?>
