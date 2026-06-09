<?php $professorInfo = $dbh->getProfessorInfo($user)[0]; ?>
<main>
    <div class="container-fluid w-auto m-3 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-lg-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3">
                <p class="m-0 p-2 fs-4">Modifica account <?php echo strtolower($_GET["accountType"]); ?></p>
            </div>
            <form action="handle_update_profile_professor.php" method="POST" enctype="multipart/form-data" class="w-100">
                <ul class="mb-0">
                    <li>
                        <label for="department" class="text-left form-label">
                            Dipartimento
                        </label>
                    </li>
                    <li>
                        <input type="text" id="department" name="department" class="form-control rounded-pill" maxlength="300" value="<?php echo $professorInfo["department"]; ?>" />
                    </li>
                    <li>
                        <label for="seat" class="text-left form-label">
                            Sede
                        </label>
                    </li>
                    <li>
                        <input type="text" id="seat" name="seat" class="form-control rounded-pill" maxlength="100" value="<?php echo $professorInfo["campus"]; ?>" />
                    </li>
                    <li>
                        <label for="infoReception" class="text-left">
                            Info ricevimento
                        </label>
                    </li>
                    <li>
                        <textarea id="infoReception" name="infoReception" class="form-control" maxlength="500"><?php echo $professorInfo["infoReception"]; ?></textarea>
                    </li>
                    <li>
                        <label for="profilePicture" class="text-left form-label">
                            Immagine profilo
                        </label>
                    </li>
                    <li>
                        <input type="file" id="profilePicture" name="profilePicture" class="form-control rounded-pill" />
                    </li>
                    <li>
                        <label class="form-label">
                            Immagine profilo corrente
                        </label>
                    </li>
                    <li>
                        <img src="<?php echo UPLOAD_DIR . "/professor/" . $dbh->getProfilePicture($_GET["professor"] . "@unibo.it"); ?>" alt=""></img>
                    </li>
                    <li class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-deepskyblue mt-3" value="Modifica" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
</main>
