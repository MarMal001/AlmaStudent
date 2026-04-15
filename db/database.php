<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    public function getDegrees() {
        $stmt = $this->db->prepare("SELECT Codice AS code, Nome AS name, Numero_Anni AS nYears, Campus AS campus 
        FROM FACOLTA 
        ORDER BY Codice");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-- TO DO -- if can't get nYears by other means through ajax 
    public function getYearsDegree($degreeCode) {
        $stmt = $this->db->prepare(
            "SELECT Numero_Anni AS nYears
            FROM FACOLTA
            WHERE Codice = ?"
        );
        $stmt->bind_param('s', $degreeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["nYears"];
    }

    //could remove year in output if not needed 
    public function getCoursesByDegreeAndYear($degreeCode, $year) {
        $stmt = $this->db->prepare(
            "SELECT c.Codice AS code, c.Nome AS courseName, c.Anno AS courseYear, c.Semestre AS semester, Descrizione_Breve AS shDescription, AVG(r.Rating_Lezioni) AS ratingL, AVG(r.Rating_Materiale) AS ratingM, AVG(r.Rating_Esame) AS ratingE, AVG(r.Rating_Disponibilita_Docenti) AS ratingD
            FROM CORSO AS c, RATING_GENERALE AS r
            WHERE c.Codice_Facolta = ?
            AND c.Anno = ?
            GROUP BY courseName"
            );
        $stmt->bind_param('ss',$degreeCode, $year);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorsByCourse($courseCode) {
        $stmt = $this->db->prepare(
            "SELECT p.Nome AS name, p.Cognome AS surname
            FROM PERSONA AS p, DOCENTE AS d, TENERE AS t
            WHERE t.Codice_Corso = ?
            AND d.Utente = t.Docente
            AND p.Utente = d.Utente"
            );
        $stmt->bind_param('s',$courseCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGeneralRatingsByCourse($courseCode) {
        $year = date("Y");
        $stmt = $this->db->prepare(
            "SELECT Rating_Lezioni AS ratingL, Rating_Materiale AS ratingM, Rating_Esame AS ratingE, Rating_Disponibilita_Docenti AS ratingD
            FROM RATING_GENERALE
            WHERE Codice_Corso = ?
            AND Anno = ?"
        );
        $stmt->bind_param('ss', $courseCode, $year);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

}

?>