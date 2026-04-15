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
    function createStars($rating) {

    }

?>