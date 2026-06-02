<?php

require_once "init.php";

if (!isAdmin() || !isset($_POST["action"])) {
    header("location: /");
    exit();
}

switch ($_POST["action"]) {
    case ADMIN_ADD_ACCOUNT:
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["type"])) {
            if ($_POST["type"] == "DOCENTE" || $_POST["type"] == "ADMIN") {
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
            if ($_POST["type"] == "DOCENTE" || $_POST["type"] == "ADMIN") {
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
        if (isset($_POST["degree"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["semester"]) && isset($_POST["code"])) {
            add_course($_POST["degree"], $_POST["name"], $_POST["year"], $_POST["semester"], $_POST["code"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
    case ADMIN_MODIFY_COURSE:
        if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["semester"]) && isset($_POST["addProfessor"]) && isset($_POST["removeProfessor"])) {
            update_course($_POST["code"], $_POST["name"], $_POST["year"], $_POST["semester"], $_POST["addProfessor"], $_POST["removeProfessor"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
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
    case ADMIN_MODIFY_DEGREE:
        if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["department"]) && isset($_POST["years"]) && isset($_POST["branch"])) {
            update_degree($_POST["code"], $_POST["name"], $_POST["department"], $_POST["years"], $_POST["branch"]);
        } else {
            $GLOBALS["message"] = "Parametri mancanti";
        }
        break;
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

    if ($GLOBALS["dbh"]->createAccount($username, $password, $name, $surname, $type, $department, $seat, $infoReception)) {
        $GLOBALS["message"] = "Account aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere l'account";
    }
}

function update_account($username, $name, $surname, $type) {
    $department = isset($_POST["department"]) ? $_POST["department"] : NULL;
    $seat = isset($_POST["seat"]) ? $_POST["seat"] : NULL;
    $infoReception = isset($_POST["infoReception"]) ? $_POST["infoReception"] : NULL;
    $profilePicture = isset($_POST["removeProfilePicture"]) ? "default.png" : NULL;

    if ($GLOBALS["dbh"]->updateAccount($username, $name, $surname, $type, $department, $seat, $infoReception, $profilePicture)) {
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

function add_course($degreeCode, $name, $year, $semester, $courseId) {
    if ($GLOBALS["dbh"]->addCourse($courseId, $name, $degreeCode, $year, $semester)) {
        $GLOBALS["message"] = "Corso aggiunto con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile aggiungere il corso";
    }
}

function update_course($code, $name, $year, $semester, $professorToAdd, $professorToRemove) {
    if ($GLOBALS["dbh"]->updateCourse($code, $name, $year, $semester, $professorToAdd, $professorToRemove)) {
        $GLOBALS["message"] = "Corso modificato con successo";
    } else {
        $GLOBALS["message"] = "Non è stato possibile modificare il corso";
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

function update_degree($code, $name, $department, $years, $branch) {
    if ($GLOBALS["dbh"]->updateDegree($code, $name, $department, $years, $branch)) {
        $GLOBALS["message"] = "Corso di laurea modificato con successo";
    } else {
        $GLOBALS["mesasge"] = "Non è stato possibile modificare il corso di laurea";
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
