<section>
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci i corsi e professori dell'ateneo.</div>
</section>
<section>
    <a href="admin_handle.php?type=handleDegrees" class="btn btn-primary">Modifica le facoltà</a>
    <a href="admin_handle.php?type=handleCourses" class="btn btn-primary">Modifica i corsi</a>
    <a href="admin_handle.php?type=addAccount&account_type=professor" class="btn btn-primary">Aggiungi account professore</a>
    <a href="admin_handle.php?type=addAccount&account_type=admin" class="btn btn-primary">Aggiungi account admin</a>
</section>