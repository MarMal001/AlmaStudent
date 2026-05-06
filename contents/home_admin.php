<section>
    <?php
        $userData = $dbh->getPersonInfo($user)[0];
        $date = "2026-04-12";//date("Y-M-d");
    ?>
    <h1 class="fw-bold">Ciao <?php echo $userData["name"]; ?>!</h1>
    <div>Gestisci i corsi e professori dell'ateneo.</div>
</section>
<section>
    <button>Modifica le facoltà</button>
    <button>Modifica i corsi</button>
    <button>Aggiungi account professore</button>
    <button>Aggiungi account admin</button>
</section>