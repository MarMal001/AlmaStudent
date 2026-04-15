<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
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
    
    public function getProfessorsByDegreeCourse($degreeCode) {
        $stmt = $this->db->prepare(
            "SELECT DISTINCT p.Nome AS name, p.Cognome AS surname
            FROM PERSONA AS p, DOCENTE AS d, TENERE AS t, CORSO AS c, FACOLTA AS f
            WHERE c.Codice_Facolta = f.Codice
            AND d.Utente = t.Docente
            AND p.Utente = d.Utente
            AND f.Codice = ?"
        );
        $stmt->bind_param("s", $degreeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReservationsOfStudent($studentCode) {
        $stmt = $this->db->prepare(
            "SELECT r.Data as date, r.Ora_inizio as startTime, r.Ora_fine as endTime, pr.Modalita_Scelta as mode, p.Nome as professorName, p.Cognome as professorSurname
            FROM Prenotazione AS pr, STUDENTE as s, RICEVIMENTO as r, PERSONA as p, DOCENTE as d
            WHERE p.Utente = d.Utente
            AND r.Docente = d.Utente
            AND pr.Codice_Ricevimento = r.Codice
            AND s.Matricola = pr.Matricola_Studente
            AND s.Matricola = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("s", $studentCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReservationsOfProfessor($professorCode) {
        $stmt = $this->db->prepare(
            "SELECT r.Data AS date, r.Ora_inizio AS startTime, r.Ora_fine AS endTime, r.Modalita AS mode, pr.Modalita_Scelta AS selectedMode, p.Nome AS studentName, p.Cognome AS studentSurname
            FROM RICEVIMENTO AS r
            LEFT JOIN Prenotazione AS pr ON r.Codice = pr.Codice_Ricevimento
            LEFT JOIN studente AS s ON s.matricola = pr.matricola_studente
            LEFT JOIN persona AS p ON p.Utente = s.Utente
            WHERE r.Docente = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("s", $professorCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>