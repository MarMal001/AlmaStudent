<section>
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci i corsi e professori dell'ateneo.</div>
</section>
<section>
    <a href="admin_modify.php?type=handleDegrees" class="btn btn-primary">Modifica le facoltà</a>
    <a href="admin_modify.php?type=handleCourse" class="btn btn-primary">Modifica corsi</a>
    <a href="admin_modify.php?type=handleAccount&accountType=professor" class="btn btn-primary">Modifica account professori</a>
    <a href="admin_modify.php?type=handleAccount&accountType=admin" class="btn btn-primary">Modifica account admins</a>
</section>