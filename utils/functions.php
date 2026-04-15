<?php 
    
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
            $sum += $rating;
        };

        $mean = $sum / count($ratingArray);
        return $mean;
    }

?>