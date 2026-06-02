<?php

require_once "init.php";

if ($_GET["action"] == "add") {
    if (!$GLOBALS["dbh"]->studentIsExistentForCourse($user, $_GET["course"])[0]["existent"]) {
        $GLOBALS["dbh"]->createSubscribedStudent($user, $_GET["course"]);
    } else {
        $GLOBALS["dbh"]->addSubscription($user, $_GET["course"]);
    }

} elseif ($_GET["action"] == "remove") {
    $GLOBALS["dbh"]->removeSubscription($user, $_GET["course"]);
}

if ($_GET["page"] == "index.php") {
    header("location: index.php");
} elseif ($_GET["page"] == "professor.php") {
    header("location: professor.php?professor=" . $_GET["professor"]);
} elseif ($_GET["page"] == "courses.php") {
    header("location: courses.php");
}else {
    header("location: course.php?course=" . $_GET["course"]);
}