<?php 
    
    require_once "init.php";

    function parseCourseYear(int $year) {
        switch ($year) {
            case 1: return "Primo";
            case 2: return "Secondo";
            case 3: return "Terzo";
            case 4: return "Quarto";
            case 5: return "Quinto";
            case 6: return "Sesto";
            default: return "Invalid";
        }
    }

    //TO DO finction that creates stars given ratings
    function createStars($rating, $color) {
        $nColored = floor($rating);
        $nWhite = 5 - $nColored;
        
        for ($i = 0; $i < $nColored; $i++) {
            echo "<i class='fa-solid fa-star' style='color:" . $color . ";'></i>";
        }; 

        if ($rating - $nColored != 0) {
            echo "<i class='fa-solid fa-star-half-stroke' style='color:" . $color . ";'></i>";
            $nWhite--;
        };

        for ($i = 0; $i < $nWhite; $i++) {
            echo "<i class='fa-regular fa-star' style='color: " . $color . ";'></i>";
        };
        
    }

    function getMeanRating($ratingArray) {
        $sum = 0;
        $mean = 0;
        foreach ($ratingArray as $rating) {
            if ($rating != NULL) {
                $sum += $rating;    
            }
        };

        $mean = $sum / count($ratingArray);
        return $mean;
    }

    function subscriptionButton($student, $courseCode, $professor = NULL) {
        $subscribed = $GLOBALS["dbh"]->checkIfSubscribedToACourse($student, $courseCode);
        $page = explode ("/", $_SERVER['SCRIPT_NAME'])[2];
        if ($page == "professor.php") {
            $professor = explode ("@", $professor)[0];
            if ($subscribed){
                echo "<a href='subscription.php?action=remove&course=" . $courseCode . "&page=" . $page . "&professor=" . $professor . "' class='btn btn-white border-primary ms-1 mt-2'>Discriviti</a>";
            } else {
                echo "<a href='subscription.php?action=add&course=" . $courseCode . "&page=" . $page . "&professor=" . $professor . "' class='btn btn-primary ms-1 mt-2'>Iscriviti</a>";
            }
        } else {
            if ($subscribed){
                echo "<a href='subscription.php?action=remove&course=" . $courseCode . "&page=" . $page ."' class='btn btn-white border-primary ms-1 mt-2'>Discriviti</a>";
            } else {
                echo "<a href='subscription.php?action=add&course=" . $courseCode . "&page=" . $page ."' class='btn btn-primary ms-1 mt-2'>Iscriviti</a>";
            }
        }
        
    }

    function isUserLoggedIn() {
        return !empty($_SESSION["username"]);
    }

    function registerLoggedUser($user) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"];
    }
    
    function isStudent() {
        return $GLOBALS["role"] == "STUDENTE";
    }

    function isProfessor() {
        return $GLOBALS["role"] == "DOCENTE";
    }

    function isAdmin() {
        return $GLOBALS["role"] == "ADMIN";
    }

    function idWithoutDomain($id) {
        $idElements = explode("@", $id);
        return $idElements[0];
    }

    function isUserReview($id) {
        return $id == $_SESSION["username"];
    }

    function generateCourseReview($url, $id, $studentId, $date, $text, $reported, $course) {
        $place = "start";
        $color = "rgb(30, 48, 80)";
        $ratings = $GLOBALS["dbh"]->getCourseRatingbyStudent($course, $studentId)[0];
        if (isUserReview($studentId)) {
            $place = "end";
        }
        echo '<div class="float-' . $place . " " . 'border border-2 border-primary rounded-3 p-2 w-75 w-lg-55">';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-md-inline-flex align-items-md-center p-0">';
        $student = $GLOBALS["dbh"]->getPersonInfo($studentId)[0];
        echo'<h5 class="me-2">' . $student["name"] . ' ' . $student["surname"] . " " . date("d/m/Y", strtotime($date)) . '</h5>';
        createStars(getMeanRating($ratings), $color);
        echo '</div>';
        if ($reported) {
            echo '<i class="fa-solid fa-flag" style="color: rgb(213, 0, 0);" ></i>';
        } else {
            echo '<button class="btn" data-bs-toggle="modal" data-bs-target="#flagModal" ><i class="fa-regular fa-flag" style="color: rgb(30, 48, 80);"></i></button>
            <div class="modal fade" id="flagModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Sei sicuro?</h5>
                    </div>

                    <div class="modal-body">
                        Confermando si segnalerà la recensione
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <a class="btn btn-danger" href="handle_reports.php?type=add&page=' . $url . '&id=' . $id . '"; ?>Conferma</a>
                    </div>

                    </div>
                </div>
                </div>';
        }
        echo '</div>';
        echo '<p>' . $text . '</p>';
        echo '</div>';
    }

    function generateProfessorReview($url, $id, $studentId, $date, $text, $reported, $professor, $course) {
        $place = "start";
        $color = "rgb(30, 48, 80)";
        $ratings = $GLOBALS["dbh"]->getProfessorRatingbyStudent($professor, $studentId)[0];
        if (isUserReview($studentId)) {
            $place = "end";
        }
        echo '<div class="float-' . $place . " " . 'border border-2 border-primary rounded-3 p-2 w-75 w-lg-55">';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-md-inline-flex align-items-md-center p-0">';
        $student = $GLOBALS["dbh"]->getPersonInfo($studentId)[0];
        echo'<h5 class="me-2">' . $student["name"] . ' ' . $student["surname"] . " " . date("d/m/Y", strtotime($date)) . '</h5>';
        createStars(getMeanRating($ratings), $color);
        echo '</div>';
        if ($reported) {
            echo '<i class="fa-solid fa-flag" style="color: rgb(213, 0, 0);" ></i>';
        } else {
            echo '<button class="btn" data-bs-toggle="modal" data-bs-target="#flagModal" ><i class="fa-regular fa-flag" style="color: rgb(30, 48, 80);"></i></button>
            <div class="modal fade" id="flagModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Sei sicuro?</h5>
                    </div>

                    <div class="modal-body">
                        Confermando si segnalerà la recensione
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <a class="btn btn-danger" href="handle_reports.php?type=add&page=' . $url . '&id=' . $id . '"; ?>Conferma</a>
                    </div>

                    </div>
                </div>
                </div>';
        }
        echo '</div>';
        $courseName = $GLOBALS["dbh"]->getCourseInfo($course)[0]["name"];
        echo '<h6 class="fw-bold ms-2 mt-2">' . $courseName . '</h6>';
        echo '<p>' . $text . '</p>';
        echo '</div>';
    }
    
    function isDesignatedProfessor($professorId, $course) {
        $validProfessor = false;
        foreach ($GLOBALS["dbh"]->getProfessorsByCourse($course) as $professor) {
            $validProfessor |= in_array($professorId, $professor);
        }
        return $validProfessor;
    }

    function isProfessorReview($type) {
        return $type == "professor";
    }
?>