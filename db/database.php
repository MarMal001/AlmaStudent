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

    public function getCourses() {
        $year = date('Y');    
        $stmt = $this->db->prepare(
            "SELECT c.Codice AS code, c.Nome AS name, c.Anno AS year, c.Semestre AS semester, f.Nome as degreeName, f.Campus as campus, Descrizione_Breve AS shortDescription, r.Rating_Lezioni AS ratingL, r.Rating_Materiale AS ratingM, r.Rating_Esame AS ratingE, r.Rating_Disponibilita_Docenti AS ratingD
            FROM CORSO AS c
            LEFT JOIN RATING_GENERALE AS r ON r.Anno = ? AND c.Codice = r.Codice_Corso
            LEFT JOIN FACOLTA AS f ON c.Codice_Facolta = f.Codice"
        );
        $stmt->bind_param('s', $year);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessors() {
        $stmt = $this->db->prepare(
            "SELECT d.Utente AS professor, p.Nome AS name, p.Cognome AS surname, AVG(r.Rating_Disponibilita) AS ratingD, AVG(r.Rating_Comprensibilita_Lezioni) AS ratingC, AVG(r.Rating_Interesse_Suscitato) AS ratingI
            FROM PERSONA AS p JOIN DOCENTE AS d ON p.Utente = d.Utente
            LEFT JOIN Tenere AS t ON t.Docente = d.Utente
            LEFT JOIN CORSO AS c ON c.Codice = t.Codice_Corso
            LEFT JOIN RATING_DOCENTE AS r ON (r.Docente = d.Utente)
            GROUP BY d.utente"
        );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdmins() {
        $stmt = $this->db->prepare(
            "SELECT a.Utente AS username, p.Nome AS name, p.Cognome AS surname
            FROM PERSONA AS p, ADMIN AS a
            WHERE p.Utente = a.Utente"
        );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDegreeByCode($degreeCode) {
        $stmt = $this->db->prepare(
            "SELECT Codice AS code, Nome as name, Numero_Anni AS nYears, Campus AS campus
            FROM FACOLTA
            WHERE Codice = ?"
        );
        $stmt->bind_param('s', $degreeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
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
            FROM PERSONA AS p JOIN DOCENTE AS d ON (p.Utente = d.Utente) 
				JOIN Tenere AS t ON (t.Docente = d.Utente) 
                JOIN CORSO AS c ON (c.Codice = t.Codice_Corso) 
                LEFT JOIN RATING_DOCENTE AS r ON (r.Docente = d.Utente)
            WHERE c.Codice_Facolta = ?
            GROUP BY d.utente;"
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
            AND sc.Codice_Corso = c.Codice
            AND sc.Iscritto = true"
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

    public function getReservationsOfStudent($student) {
        $stmt = $this->db->prepare(
            "SELECT r.Ora_inizio AS startTime, r.Ora_fine AS endTime, r.Data as date, pr.Modalita_Scelta AS mode, p.Nome AS name, p.Cognome AS surname
            FROM Prenotazione AS pr, RICEVIMENTO AS r, PERSONA AS p, DOCENTE AS d
            WHERE p.Utente = d.Utente
            AND r.Docente = d.Utente
            AND r.Docente = pr.Docente
            AND r.Data = pr.Data
            AND r.Ora_Inizio = pr.Ora_Inizio
            AND pr.Studente = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("s", $student);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReservationsOfProfessor($professorCode) {
        $stmt = $this->db->prepare(
            "SELECT r.Ora_inizio AS startTime, r.Ora_fine AS endTime, r.Data as date, r.Modalita AS mode, pr.Modalita_Scelta AS reservedMode, p.Nome AS name, p.Cognome AS surname
            FROM RICEVIMENTO AS r
            LEFT JOIN Prenotazione AS pr ON r.Docente = pr.Docente AND r.Data = pr.Data AND r.Ora_Inizio = pr.Ora_Inizio
            LEFT JOIN STUDENTE AS s ON s.Utente = pr.Studente
            LEFT JOIN PERSONA AS p ON p.Utente = s.Utente
            WHERE r.Docente = ?
            ORDER BY r.Ora_inizio"
        );
        $stmt->bind_param("s", $professorCode);
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
                AND sc.Iscritto = true
            ) AS subscribed"
        );
        $stmt->bind_param("ss", $student, $courseCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["subscribed"];
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
            "SELECT p.Nome AS name, p.Cognome AS surname, d.Dipartimento AS department, d.Sede AS campus, d.Info_Ricevimento AS infoReception, d.Foto_Profilo AS photo
            FROM DOCENTE AS d, PERSONA AS p
            WHERE d.Utente = ?
            AND d.Utente = p.Utente"
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

    private function createProfessor($username, $department, $seat, $infoReception, $profilePicture) {
        $stmt = $this->db->prepare(
            "INSERT INTO DOCENTE values
            (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $department, $seat, $infoReception, $profilePicture);
        return $stmt->execute();
    }

    private function createStudent($studentId, $username) {
        $stmt = $this->db->prepare(
            "INSERT INTO STUDENTE values
            (?, ?, null, 0)"
        );
        $stmt->bind_param("ss", $studentId, $username);
        return $stmt->execute();
    }

    public function createAccount($username, $password, $name, $surname, $role, $studentId = NULL, $department = NULL, $seat = NULL, $infoReception = NULL, $profilePicture = NULL) {
        $stmt = $this->db->prepare(
            "INSERT INTO PERSONA values
            (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $password, $name, $surname, $role);
        $success = $stmt->execute();
        try {
            if ($role == "ADMIN") {
                $success = $this->createAdmin($username);
            } else if ($role == "DOCENTE") {
                $success = $this->createProfessor($username, $department, $seat, $infoReception, $profilePicture);
            } else if ($role == "STUDENTE") {
                $success = $this->createStudent($studentId, $username);
            }
        } catch (mysqli_sql_exception $e) {
            echo $e;
            $success = false;
        }
        if (!$success) {
            $stmt = $this->db->prepare(
                "DELETE FROM PERSONA WHERE Utente = ?"
            );
            $stmt->bind_param("s", $username);
            $stmt->execute();
            return false;
        }
        return true;
    }

    public function getReviewsByCourse($course) {
        $stmt = $this->db->prepare(
            "SELECT r.Codice AS id, r.Data AS date, rd.Studente AS student, rv.Testo AS text, rv.Segnalazione AS reported
            FROM RATING AS r, RATING_CORSO AS rd, REVIEW AS rv
            WHERE r.Codice = rd.Codice
            AND rd.Corso = ?
            AND rv.Codice_Rating = r.Codice
            ORDER BY r.Data
            "
        );
        $stmt->bind_param("s", $course);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviewsByProfessor($professor) {
        $stmt = $this->db->prepare(
            "SELECT r.Codice AS id, r.Data AS date, rd.Studente AS student, rd.Corso AS course, rv.Testo AS text, rv.Segnalazione AS reported
            FROM RATING AS r, RATING_DOCENTE AS rd, REVIEW AS rv
            WHERE r.Codice = rd.Codice
            AND rv.Codice_Rating = r.Codice
            AND rd.Docente = ?
            ORDER BY r.Data
            "
        );
        $stmt->bind_param("s", $professor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourseRatingbyStudent($course, $student) {
        $stmt = $this->db->prepare(
            "SELECT rd.Rating_Lezioni AS rating_L, rd.Rating_Materiale AS rating_M, rd.Rating_Esame AS rating_E
            FROM RATING_CORSO AS rd
            WHERE rd.Corso = ?
            AND rd.Studente = ?
            "
        );
        $stmt->bind_param("ss", $course, $student);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorRatingbyStudent($professor, $student) {
        $stmt = $this->db->prepare(
            "SELECT rd.Rating_Disponibilita AS rating_D, rd.Rating_Comprensibilita_Lezioni AS rating_C, rd.Rating_Interesse_Suscitato AS rating_I
            FROM RATING_DOCENTE AS rd
            WHERE rd.Docente = ?
            AND rd.Studente = ?
            "
        );
        $stmt->bind_param("ss", $professor, $student);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateCourseProfessor($course, $description, $shortDescription, $material) {
        $stmt = $this->db->prepare(
            "UPDATE CORSO
            SET Descrizione = ?, Descrizione_Breve = ?, Materiale = ?
            WHERE Codice = ?"
        );
        $stmt->bind_param("ssss", $description, $shortDescription, $material, $course);
        return $stmt->execute();
    }

    public function getReportedReviewsOfProfessors() {
        $stmt = $this->db->prepare(
            "SELECT r.Codice AS id, r.Data AS date, rd.Studente AS student, p.Nome AS profName, p.Cognome AS profSurname, p.Utente AS professor
            FROM RATING AS r, RATING_DOCENTE AS rd, REVIEW AS rv, PERSONA AS p
            WHERE rv.Segnalazione = true
            AND rv.Codice_Rating = r.Codice
            AND r.Codice = rd.Codice
            AND rd.Docente = p.Utente
            ORDER BY student, profName, profSurname
            "
        );

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReportedReviewsOfCourses() {
        $stmt = $this->db->prepare(
            "SELECT r.Codice AS id, r.Data AS date, rc.Studente AS student, c.Nome AS courseName, c.Codice AS courseId
            FROM RATING AS r, RATING_CORSO AS rc, CORSO AS c, REVIEW AS rv
            WHERE rv.Segnalazione = true
            AND rv.Codice_Rating = r.Codice
            AND r.Codice = rc.Codice
            AND c.Codice = rc.Corso
            ORDER BY student, courseName
            "
        );
        
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCourse($code, $name, $degreeCode, $year, $semester) {
        $stmt = $this->db->prepare(
            "INSERT INTO CORSO values
            (?, ?, ?, ?, ?, '', '', '')"
        );
        $stmt->bind_param("sssss", $code, $name, $year, $semester, $degreeCode);
        return $stmt->execute();
    }

    public function addDegree($code, $name, $department, $years, $branch) {
        $stmt = $this->db->prepare(
            "INSERT INTO FACOLTA values
            (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $code, $name, $department, $years, $branch);
        return $stmt->execute();
    }

    public function updateAccount($username, $name, $surname, $role, $department, $seat, $infoReception, $profilePicture) {
        $stmt = $this->db->prepare(
            "UPDATE PERSONA
            SET Nome = ?, Cognome = ?
            WHERE Utente = ?"
        );
        $stmt->bind_param("sss", $name, $surname, $username);
        $success = $stmt->execute();
        if (!$success) {
            return false;
        }
        if ($role == "DOCENTE") {
            if ($profilePicture == NULL) {
                $stmt = $this->db->prepare(
                    "UPDATE DOCENTE
                    SET Dipartimento = ?, Sede = ?, Info_Ricevimento = ?
                    WHERE Utente = ?"
                );
                $stmt->bind_param("ssss", $department, $seat, $infoReception, $username);
            } else {
                $stmt = $this->db->prepare(
                    "UPDATE DOCENTE
                    SET Dipartimento = ?, Sede = ?, Info_Ricevimento = ?, Foto_Profilo = ?
                    WHERE Utente = ?"
                );
                $stmt->bind_param("sssss", $department, $seat, $infoReception, $profilePicture, $username);
            }
            $success = $stmt->execute();
        }
        return $success;
    }

    public function updateCourse($code, $name, $year, $semester, $professorToAdd, $professorToRemove) {
        $stmt = $this->db->prepare(
            "UPDATE CORSO
            SET Nome = ?, Anno = ?, Semestre = ?
            WHERE Codice = ?"
        );
        $stmt->bind_param("ssss", $name, $year, $semester, $code);
        $success = $stmt->execute();
        if (!$success) {
            return false;
        }
        if ($professorToAdd != "") {
            $stmt = $this->db->prepare(
                "INSERT INTO Tenere values
                (?, ?)"
            );
            $stmt->bind_param("ss", $professorToAdd, $code);
            $success = $stmt->execute();
        }
        if ($professorToRemove != "") {
            $stmt = $this->db->prepare(
                "DELETE FROM Tenere WHERE Docente = ? AND Codice_Corso = ?"
            );
            $stmt->bind_param("ss", $professorToRemove, $code);
            $success = $stmt->execute();
        }

        return $success;
    }

    public function updateDegree($code, $name, $department, $years, $branch) {
        $stmt = $this->db->prepare(
            "UPDATE FACOLTA
            SET Nome = ?, Dipartimento = ?, Numero_Anni = ?, Campus = ?
            WHERE Codice = ?"
        );
        $stmt->bind_param("sssss", $name, $department, $years, $branch, $code);
        return $stmt->execute();
    }

    public function deleteCourse($code) {
        $stmt = $this->db->prepare(
            "DELETE FROM CORSO WHERE Codice = ?"
        );
        $stmt->bind_param("s", $code);
        return $stmt->execute();
    }

    public function deleteAccount($code, $type) {
        $stmt = null;
        if ($type == "admin") {
            $stmt = $this->db->prepare(
                "DELETE FROM ADMIN WHERE Utente = ?"
            );
        } else if ($type == "professor") {
            $stmt = $this->db->prepare(
                "DELETE FROM DOCENTE WHERE Utente = ?"
            );
        } else {
            return false;
        }

        $stmt->bind_param("s", $code);
        if (!$stmt->execute()) {
            return false;
        }
        $stmt = $this->db->prepare(
            "DELETE FROM PERSONA WHERE Utente = ?"
        );
        $stmt->bind_param("s", $code);
        return $stmt->execute();
    }

    public function deleteDegree($code) {
        $stmt = $this->db->prepare(
            "DELETE FROM FACOLTA WHERE Codice = ?"
        );
        $stmt->bind_param("s", $code);
        return $stmt->execute();
    }

    public function getReviewInfo($id) {
        $stmt = $this->db->prepare(
            "SELECT rv.Testo AS text, r.Data AS date,
            CASE 
	            WHEN r.Codice = rd.Codice THEN rd.Studente
	            WHEN r.Codice = rc.Codice THEN rc.Studente
            END AS student
            FROM RATING AS r LEFT JOIN RATING_CORSO AS rc ON (r.Codice = rc.Codice) LEFT JOIN RATING_DOCENTE AS rd ON (r.Codice = rd.Codice), REVIEW AS rv
            WHERE r.Codice = ?
            AND (r.Codice = rd.Codice OR r.Codice = rc.Codice)
            AND r.Codice = rv.Codice_Rating"
        );
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRatingsFromId($id) {
        $stmt = $this->db->prepare(
            "SELECT 
            CASE 
                WHEN r.Codice = rc.Codice THEN rc.Rating_Lezioni
                WHEN r.Codice = rd.Codice THEN rd.Rating_Disponibilita
            END AS rating1,
            CASE
                WHEN r.Codice = rc.Codice THEN rc.Rating_Materiale
                WHEN r.Codice = rd.Codice THEN rd.Rating_Comprensibilita_Lezioni
            END AS rating2,
            CASE
                WHEN r.Codice = rc.Codice THEN rc.Rating_Esame
                WHEN r.Codice = rd.Codice THEN rd.Rating_Interesse_Suscitato
            END AS rating3
            FROM RATING AS r LEFT JOIN RATING_CORSO AS rc ON (r.Codice = rc.Codice) LEFT JOIN RATING_DOCENTE AS rd ON (r.Codice = rd.Codice)
            WHERE r.Codice = ?
            "
        );
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeReportedReview($id, $student) {
        $stmt = $this->db->prepare(
            "DELETE 
            FROM RATING 
            WHERE Codice = ?"
        );
        $stmt->bind_param("s", $id);
        $state= $stmt->execute();
        if (!$state) {
            return false;
        }
        $stmt = $this->db->prepare(
            "UPDATE STUDENTE 
            SET Numero_Segnalazioni = Numero_Segnalazioni + 1
            WHERE Utente = ?"
        );
        $stmt->bind_param("s", $student);
        $state = $stmt->execute();
        if (!$state) {
            return false;
        }
        if($this->getStudentNumberReports($student)[0]["numReports"] == 3) {
            $stmt = $this->db->prepare(
                "UPDATE STUDENTE 
                SET Data_Ban = CURDATE()
                WHERE Utente = ?"
            );

            $stmt->bind_param("s", $student);
            $state = $stmt->execute();
        }
        
        return $state;
    } 

    public function annulReport($id) {
        $stmt = $this->db->prepare(
            "UPDATE REVIEW
            SET Segnalazione = false
            WHERE Codice_Rating = ?"
        );
        $stmt->bind_param("s", $id);
        $state = $stmt->execute();
        return $state;
    }

    public function getStudentNumberReports($student) {
        $stmt = $this->db->prepare(
            "SELECT Numero_Segnalazioni AS numReports
            FROM STUDENTE
            WHERE Utente = ?
            "
        );
        $stmt->bind_param("s", $student);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addReportToAReview($id) {
        $stmt = $this->db->prepare(
            "UPDATE REVIEW
            SET Segnalazione = true
            WHERE Codice_Rating = ?
            "
        );
        $stmt->bind_param("s", $id);
        $state = $stmt->execute();
        return $state;
    }

    public function studentIsExistentForCourse($student, $course) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM STUDENTE_IN_CORSO AS sc
                WHERE sc.Utente = ?
                AND sc.Codice_Corso = ?
            ) as existent
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createSubscribedStudent($student, $course){
        $stmt = $this->db->prepare(
            "INSERT INTO Studente_In_Corso (
            Utente, Codice_Corso, Iscritto, Esame_Superato)
            VALUES (?, ?, true, false)
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $state = $stmt->execute();
        return $state;
    }

    public function addSubscription($student, $course) {
        $stmt = $this->db->prepare(
            "UPDATE Studente_In_Corso AS sc
            SET sc.Iscritto = true
            WHERE sc.Utente = ?
            AND sc.Codice_Corso = ?
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $state = $stmt->execute();
        return $state;
    }

    public function removeSubscription($student, $course) {
        $stmt = $this->db->prepare(
            "UPDATE Studente_In_Corso AS sc
            SET sc.Iscritto = false
            WHERE sc.Utente = ?
            AND sc.Codice_Corso = ?
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $state = $stmt->execute();
        return $state;
    }

    public function canRateCourse($student, $course) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM STUDENTE_IN_CORSO AS sc
                WHERE sc.Utente = ?
                AND sc.Codice_Corso = ?
                AND sc.Esame_Superato = true
            ) AS existence
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function canRateProfessor($student, $professor) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM STUDENTE_IN_CORSO AS sc, Tenere AS t
                WHERE sc.Utente = ?
                AND t.Docente = ?
                AND sc.Codice_Corso = t.Codice_Corso
                AND sc.Esame_Superato = true
            ) AS existence
            "
        );
        $stmt->bind_param("ss", $student, $professor);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function professorExists($professor) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM DOCENTE AS d
                WHERE d.Utente = ?
            ) AS existence
            "
        );
        $stmt->bind_param("s", $professor);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["existence"];
    }

    public function courseExists($course) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM CORSO AS c
                WHERE c.Codice = ?
            ) AS existence
            "
        );
        $stmt->bind_param("s", $course);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["existence"];
    }

    public function courseIsAlreadyRated($student, $course) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM RATING_CORSO AS rc
                WHERE rc.Studente = ?
                AND rc.Corso = ?
            ) AS existence
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["existence"];
    }

    public function professorsOfCourseAlreadyRated($student, $course) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM RATING_DOCENTE AS rd
                WHERE rd.Studente = ?
                AND rd.Corso = ?
            ) AS existence
            "
        );
        $stmt->bind_param("ss", $student, $course);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["existence"];
    }

    public function createCourseRating($student, $course, $ratingL, $ratingM, $ratingE) {
        $stmt = $this->db->prepare(
            'INSERT INTO RATING VALUES (null, "CORSO", CURDATE())'
        );
        $stmt->execute();
        $stmt = $this->db->prepare(
            "SELECT Codice AS code
            FROM RATING AS r
            WHERE r.Codice = LAST_INSERT_ID()
            "
        );
        $stmt->execute();
        $result = $stmt->get_result();
        $code = $result->fetch_all(MYSQLI_ASSOC)[0]["code"];
        $stmt = $this->db->prepare(
            "INSERT INTO RATING_CORSO VALUES (?, ?, ?, ?, ?, ?);"
        );
        $stmt->bind_param("ssssss", $code, $student, $course, $ratingL, $ratingM, $ratingE);
        $state = $stmt->execute();
        return $code;
    }

    public function createReview($code, $text) {
        $stmt = $this->db->prepare(
            "INSERT INTO REVIEW VALUES (?, ?, false);"
        );
        $stmt->bind_param("ss", $code, $text);
        $state = $stmt->execute();
        return $state;
    }

    public function createProfessorRating($professor, $student, $course, $ratingD, $ratingC, $ratingI) {
        $stmt = $this->db->prepare(
            'INSERT INTO RATING VALUES (null, "DOCENTE", CURDATE())'
        );
        $stmt->execute();
        $stmt = $this->db->prepare(
            "SELECT Codice AS code
            FROM RATING AS r
            WHERE r.Codice = LAST_INSERT_ID()
            "
        );
        $stmt->execute();
        $result = $stmt->get_result();
        $code = $result->fetch_all(MYSQLI_ASSOC)[0]["code"];
        $stmt = $this->db->prepare(
            "INSERT INTO RATING_DOCENTE VALUES (?, ?, ?, ?, ?, ?, ?);"
        );
        $stmt->bind_param("sssssss", $code, $professor, $student, $course, $ratingD, $ratingC, $ratingI);
        $state = $stmt->execute();
        return $code;
    }

    public function isStudentBanned($student) {
        $stmt = $this->db->prepare(
            "SELECT EXISTS (
                SELECT 1
                FROM STUDENTE AS s
                WHERE s.Utente = ?
                AND s.Data_Ban IS NOT null
            ) AS existence
            "
        );
        $stmt->bind_param("s", $student);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["existence"];
    }

    public function studentMustBeDebanned($student) {
        $stmt = $this->db->prepare(
            "SELECT DATEDIFF(CURDATE(), s.Data_Ban) AS numDays
            FROM STUDENTE AS s
            WHERE s.Utente = ?
            "
        );
        $stmt->bind_param("s", $student);
        $stmt->execute();
        $result = $stmt->get_result();
        $numDays = $result->fetch_all(MYSQLI_ASSOC)[0]["numDays"];
        return $numDays > 30;
    }

    public function debanStudent($student) {
        $stmt = $this->db->prepare(
            "UPDATE STUDENTE AS s
            SET s.Data_Ban = null, s.Numero_Segnalazioni = 0
            "
        );
        $stmt->execute();
    }
}

?>
             