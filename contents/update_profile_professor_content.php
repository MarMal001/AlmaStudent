<?php
$professorInfo = $dbh->getProfessorInfo($user)[0];
?>

<main>
    <section>
        <form action="handle_update_profile_professor.php" method="POST" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="department" class="text-left">
                        <h5>Dipartimento</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="department" name="department" value="<?php echo $professorInfo["department"]; ?>" />
                </li>
                <li>
                    <label for="seat" class="text-left">
                        <h5>Sede</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="seat" name="seat" value="<?php echo $professorInfo["campus"]; ?>" />
                </li>
                <li>
                    <label for="infoReception" class="text-left">
                        <h5>Info ricevimento</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="infoReception" name="infoReception" value="<?php echo $professorInfo["infoReception"]; ?>" />
                </li>
                <li>
                    <label for="profilePicture" class="text-left">
                        <h5>Immagine profilo</h5>
                    </label>
                </li>
                <li>
                    <input type="file" id="profilePicture" name="profilePicture" />
                </li>
                <li>
                    <label for="currentProfilePicture">
                        <h5>Immagine profilo corrente</h5>
                    </label>
                </li>
                <li>
                    <img src="<?php echo UPLOAD_DIR . "/professor/" . $dbh->getProfilePicture($_GET["professor"] . "@unibo.it"); ?>" alt=""></img>
                </li>
                <li>
                    <input type="submit" class="btn btn-primary mt-3" value="Modifica" />
                </li>
            </ul>
        </form>
    </section>
</main>
