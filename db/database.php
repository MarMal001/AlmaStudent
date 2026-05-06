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
    $date = date('Y');    
    $stmt = $this->db->prepare(
            "SELECT c.Codice AS code, c.Nome AS name, c.Anno AS year, c.Semestre AS semester, Descrizione_Breve AS shortDescription, r.Rating_Lezioni AS ratingL, r.Rating_Materiale AS ratingM, r.Rating_Esame AS ratingE, r.Rating_Disponibilita_Docenti AS ratingD
            FROM CORSO AS c LEFT JOIN RATING_GENERALE AS r ON r.Codice_Corso = c.Codice AND r.Anno = ?
            WHERE c.Codice_Facolta = ?
            AND c.Anno = ?"
            );
        $stmt->bind_param('sss', $date, $degreeCode, $year);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorsByDegree($degreeCode) {
        $stmt = $this->db->prepare(
            "SELECT d.Utente AS professor, p.Nome AS name, p.Cognome AS surname, AVG(r.Rating_Disponibilita) AS ratingD, AVG(r.Rating_Comprensibilita_Lezioni) AS ratingC, AVG(r.Rating_Interesse_Suscitato) AS ratingI
            FROM PERSONA AS p, DOCENTE AS d, CORSO AS c, Tenere AS t, RATING_DOCENTE AS r
            WHERE c.Codice_Facolta = ?
            AND c.Codice = t.Codice_Corso
            AND t.Docente = d.Utente
            AND r.Docente = d.Utente
            AND p.Utente = d.Utente
            GROUP BY professor"
        );

        $stmt->bind_param('s', $degreeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorsByCourse($courseCode) {
        $stmt = $this->db->prepare(
            "SELECT p.Utente AS professor, p.Nome AS name, p.Cognome AS surname
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

    public function getCoursesByProfessor($professor) {
        $stmt = $this->db->prepare(
            "SELECT c.Codice AS code, c.Nome AS name, c.Descrizione_Breve AS shortDescription
            FROM DOCENTE AS d, CORSO AS c, Tenere AS t
            WHERE d.Utente = ?
            AND d.Utente = t.Docente
            AND t.Codice_Corso = c.Codice"
        );

        $stmt->bind_param('s', $professor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentCourses($student) {
        $stmt = $this->db->prepare(
            "SELECT c.Codice AS code, c.Nome AS name, c.Descrizione_Breve AS shortDescription
            FROM STUDENTE_IN_CORSO AS sc, CORSO AS c 
            WHERE sc.Utente = ?
            AND sc.Codice_Corso = c.Codice"
        );
        $stmt->bind_param('s', $student);
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

    public function getReservationsOfStudent($student, $date) {
        $stmt = $this->db->prepare(
            "SELECT r.Ora_inizio AS startTime, r.Ora_fine AS endTime, pr.Modalita_Scelta AS mode, p.Nome AS name, p.Cognome AS surname
            FROM Prenotazione AS pr, RICEVIMENTO AS r, PERSONA AS p, DOCENTE AS d
            WHERE p.Utente = d.Utente
            AND r.Docente = d.Utente
            AND r.Docente = pr.Docente
            AND r.Data = pr.Data
            AND r.Ora_Inizio = pr.Ora_Inizio
            AND pr.Studente = ?
            AND r.Data = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("ss", $student, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReservationsOfProfessor($professorCode, $date) {
        $stmt = $this->db->prepare(
            "SELECT r.Ora_inizio AS startTime, r.Ora_fine AS endTime, r.Modalita AS mode, pr.Modalita_Scelta AS mode, p.Nome AS name, p.Cognome AS surname
            FROM RICEVIMENTO AS r
            LEFT JOIN Prenotazione AS pr ON r.Docente = pr.Docente AND r.Data = pr.Data AND r.Ora_Inizio = pr.Ora_Inizio
            LEFT JOIN STUDENTE AS s ON s.Utente = pr.Studente
            LEFT JOIN PERSONA AS p ON p.Utente = s.Utente
            WHERE r.Docente = ?
            AND r.Data = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("ss", $professorCode, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addAvailabilityOfProfessor($professorCode, $date, $startTime, $endTime, $mode) {
        $stmt = $this->db->prepare(
            "INSERT INTO RICEVIMENTO values
            (?, ?, ?, ?, ?)"
        );

        $parsedMode = ""; 
        if ($mode == "online") {
            $parsedMode = "Online";
        } else if ($mode == "presence") {
            $parsedMode = "Presenza";
        } else {
            $parsedMode = "Online e in presenza";
        }
        $stmt->bind_param("sssss", $professorCode, $date, $startTime, $endTime, $parsedMode);
        return $stmt->execute();
    }

    public function checkAvailabilityReferencesOfProfessor($professorCode) {
        $stmt = $this->db->prepare(
            "SELECT s.Matricola, p.Nome, p.Cognome
            FROM RICEVIMENTO AS r
            LEFT JOIN Prenotazione AS pr ON r.Docente = pr.Docente AND r.Data = pr.Data AND r.Ora_Inizio = pr.Ora_Inizio
            LEFT JOIN STUDENTE AS s ON pr.Matricola_Studente = s.Matricola
            LEFT JOIN PERSONA AS p ON p.Utente = s.Utente
            WHERE r.Docente = ?"
        );

        $stmt->bind_param("s", $professorCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateAvailabilityOfProfessor($professorCode, $date, $startTime, $mode) {
        $stmt = $this->db->prepare(
            "UPDATE RICEVIMENTO
            SET Modalita = ?
            WHERE Docente = ?
            AND Data = ?
            AND Ora_Inizio = ?"
        );

        $parsedMode = ""; 
        if ($mode == "online") {
            $parsedMode = "Online";
        } else if ($mode == "presence") {
            $parsedMode = "Presenza";
        } else {
            $parsedMode = "Online e in presenza";
        }
        $stmt->bind_param("ssss", $parsedMode, $professorCode, $date, $startTime);
        return $stmt->execute();
    }

    public function removeAvailabilityOfProfessor($professorCode, $date, $startTime) {
        $stmt = $this->db->prepare(
            "DELETE FROM RICEVIMENTO
            WHERE Docente = ?
            AND Data = ?
            AND Ora_Inizio = ?"
        );

        $stmt->bind_param("sss", $professorCode, $date, $startTime);
        return $stmt->execute();
    }

    public function getPersonInfo($user) {
        $stmt = $this->db->prepare(
            "SELECT p.Nome AS name, p.Cognome AS surname, p.Password AS password
            FROM PERSONA AS p
            WHERE p.Utente = ?"
        );
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkIfSubscribedToACourse($student, $courseCode) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM STUDENTE_IN_CORSO AS sc
                WHERE sc.Utente = ?
                AND sc.Codice_Corso = ?
            ) AS subscribed"
        );
        $stmt->bind_param("ss", $student, $courseCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorRatings($professor) {
        $stmt = $this->db->prepare(
            "SELECT AVG(r.Rating_Disponibilita) AS ratingD, AVG(r.Rating_Comprensibilita_Lezioni) AS ratingC, AVG(r.Rating_Interesse_Suscitato) AS ratingI
            FROM RATING_DOCENTE AS r
            WHERE r.Docente = ?"
        );
        $stmt->bind_param("s", $professor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function checkLogin($username, $password) {
        $stmt = $this->db->prepare(
            "SELECT p.Utente as username, p.Nome as name, p.ruolo as role
            FROM PERSONA as p
            WHERE p.Utente = ?
            AND p.Password = ?"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorInfo($professor) {
        $stmt = $this->db->prepare(
            "SELECT d.Dipartimento AS department, d.Sede AS campus, d.Info_Ricevimento AS infoReception, d.Foto_Profilo AS photo
            FROM DOCENTE AS d
            WHERE d.Utente = ?"
        );
        $stmt->bind_param("s", $professor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourseInfo($course) {
        $stmt = $this->db->prepare(
            "SELECT c.Nome AS name, c.Descrizione AS description, c.Descrizione_Breve AS shortDescription, c.Materiale AS material
            FROM CORSO AS c
            WHERE c.Codice = ?
            "
        );
        $stmt->bind_param("s", $course);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function createAdmin($username) {
        $stmt = $this->db->prepare(
            "INSERT INTO ADMIN values
            (?)"
        );
        $stmt->bind_param("s", $username);
        return $stmt->execute();
    }

    private function createProfessor($username) {
        $stmt = $this->db->prepare(
            "INSERT INTO PROFESSORE values
            (?)"
        );
        $stmt->bind_param("s", $username);
        return $stmt->execute();
    }

    private function createStudent($studentId, $username) {
        $stmt = $this->db->prepare(
            "INSERT INTO STUDENTE values
            (?, ?, false, null, 0)"
        );
        $stmt->bind_param("ss", $studentId, $username);
        return $stmt->execute();
    }

    public function createAccout($username, $password, $name, $surname, $role, $studentId = NULL) {
        $stmt = $this->db->prepare(
            "INSERT INTO PERSONA values
            (?, ?, ?, ?, ?)"
        );
        $success = true;
        if (strtolower($role) == "admin") {
            $success = $this->createAdmin($username);
        } else if (strtolower($role) == "professor") {
            $success = $this->createProfessor($username);
        } else if (strtolower($role) == "student") {
            try {
                $success = $this->createStudent($studentId, $username);
            } catch (mysqli_sql_exception $e) {
                $success = false;
            }
        }
        if (!$success) {
            return false;
        }
        $stmt->bind_param("sssss", $username, $password, $name, $surname, $role);
        return $stmt->execute();
    }
}

?>