<?php

    require_once "init.php";

    $code = $dbh->createCourseRating($user, $_POST["course"], $_POST["ratingL"], $_POST["ratingM"], $_POST["ratingE"]);
    if (isset($_POST["review"]) && $_POST["review"] != "") {
        $dbh->createReview($code, $_POST["review"]);
    }
    
    header("location: rating_professor.php?course=" . $_POST["course"]);