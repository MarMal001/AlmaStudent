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

    function subscriptionButton($student, $courseCode) {
        $subscribed = $GLOBALS["dbh"]->checkIfSubscribedToACourse($student, $courseCode);
        if ($subscribed[0]["subscribed"]){
            echo "<button class='btn btn-white border-primary ms-1' type='submit'>Discriviti</button>";
        } else {
            echo "<button class='btn btn-primary ms-1' type='submit'>Iscriviti</button>";
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
?>