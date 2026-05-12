<section>
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci i corsi e professori dell'ateneo.</div>
</section>
<section>
    <a href=# class="btn btn-primary">Modifica le facoltà</a>
    <a href=# class="btn btn-primary">Modifica i corsi</a>
    <a href=# class="btn btn-primary">Aggiungi account professore</a>
    <a href=# class="btn btn-primary">Aggiungi account admin</a>
</section>