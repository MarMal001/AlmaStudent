<main>
    <?php if (!isset($_GET["accountType"]))
        header("location: index.php");
    ?>

    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0 p-2">Aggiungi account <?php echo strtolower($_GET["accountType"]); ?></p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="name" class="text-left">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="name" name="name" />
                </li>
                <li>
                    <label for="surname" class="text-left">
                        <h5>Cognome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="surname" name="surname" />
                </li>
                <li>
                    <label for="username" class="text-left">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <input type="email" id="username" name="username" />
                </li>
                <li>
                    <label for="password" class="text-left">
                        <h5>Password</h5>
                    </label>
                </li>
                <li>
                    <input type="password" id="password" name="password" />
                </li>
                <?php if ($_GET["accountType"] == "DOCENTE"): ?>
                    <li>
                        <label for="department" class="text-left">
                            <h5>Dipartimento</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="department" name="department" />
                    </li>
                    <li>
                        <label for="seat" class="text-left">
                            <h5>Sede</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="seat" name="seat" />
                    </li>
                    <li>
                        <label for="infoReception" class="text-left">
                            <h5>Info ricevimento</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="infoReception" name="infoReception" />
                    </li>
                    <li>
                        <label for="profilePicture" class="text-left">
                            <h5>Immagine profilo</h5>
                        </label>
                    </li>
                    <li>
                        <input type="file" id="profilePicture" name="profilePicture" />
                    </li>
                <?php endif; ?>
                <li>
                    <button type="submit" class="btn btn-primary mt-3" name="action" value="<?php echo ADMIN_ADD_ACCOUNT; ?>">Crea account</button>
                </li>
            </ul>
            <input type="hidden" name="type" value="<?php echo $_GET["accountType"]; ?>" />
        </form>
    </section>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
            <p class="m-0 p-2">Modifica account <?php echo strtolower($_GET["accountType"]); ?></p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="username" class="text-left">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <?php if ($_GET["accountType"] == "DOCENTE"): ?>
                        <select id="updateProfessorCode" name="username" onchange="getUpdateProfessorForm()">
                            <option value="">-- Seleziona --</option>
                            <?php foreach ($dbh->getProfessors() as $professor): ?>
                                <option value="<?php echo $professor["professor"]; ?>"><?php echo $professor["name"] . " " . $professor["surname"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif($_GET["accountType"] == "ADMIN"): ?>
                        <select id="updateAdminCode" name="username" onchange="getUpdateAdminForm()">
                            <option value="">-- Seleziona --</option>
                            <?php foreach ($dbh->getAdmins() as $admin): ?>
                                <option value="<?php echo $admin["username"]; ?>"><?php echo $admin["name"] . " " . $admin["surname"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </li>
                <div id="<?php echo $_GET["accountType"] == "DOCENTE" ? "updateProfessorForm" : "updateAdminForm"; ?>"></div>
            </ul>
            <input type="hidden" name="type" value="<?php echo $_GET["accountType"]; ?>" />
        </form>
    </section>
</main>
