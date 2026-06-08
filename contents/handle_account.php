<main>
    <?php if (!isset($_GET["accountType"]))
        header("location: index.php");
    ?>
    <section class="container-fluid w-auto mx-2 mt-5 p-0 mb-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
                <h4 class="m-0 p-2 text-darkbluenavy">Aggiungi account <?php echo strtolower($_GET["accountType"]); ?></h4>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse px-3 pb-3 w-100 show">
                <ul class="mb-0">
                    <li>
                        <label for="name" class="text-left form-label">
                            Nome
                        </label>
                    </li>
                    <li>
                        <input type="text" id="name" name="name" class="form-control rounded-pill" required />
                    </li>
                    <li>
                        <label for="surname" class="text-left form-label">
                            Cognome
                        </label>
                    </li>
                    <li>
                        <input type="text" id="surname" name="surname" class="form-control rounded-pill" required />
                    </li>
                    <li>
                        <label for="username" class="text-left form-label">
                            Username
                        </label>
                    </li>
                    <li>
                        <input type="email" id="username" name="username" class="form-control rounded-pill" required />
                    </li>
                    <li>
                        <label for="password" class="text-left form-label">
                            Password
                        </label>
                    </li>
                    <li>
                        <input type="password" id="password" name="password" class="form-control rounded-pill" required />
                    </li>
                    <?php if ($_GET["accountType"] == "DOCENTE"): ?>
                        <li>
                            <label for="department" class="text-left">
                                Dipartimento
                            </label>
                        </li>
                        <li>
                            <input type="text" id="department" name="department" class="form-control rounded-pill" />
                        </li>
                        <li>
                            <label for="seat" class="text-left form-label">
                                Sede
                            </label>
                        </li>
                        <li>
                            <input type="text" id="seat" name="seat" class="form-control rounded-pill" />
                        </li>
                        <li>
                            <label for="infoReception" class="text-left form-label">
                                Info ricevimento
                            </label>
                        </li>
                        <li>
                            <input type="text" id="infoReception" name="infoReception" class="form-control rounded-pill" />
                        </li>
                    <?php endif; ?>
                    <li>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-deepskyblue mt-3" name="action" value="<?php echo ADMIN_ADD_ACCOUNT; ?>">Crea account</button>
                        </div>
                    </li>
                </ul>
                <input type="hidden" name="type" value="<?php echo $_GET["accountType"]; ?>" />
            </form>
        </div>
    </section>
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                <h4 class="m-0 p-2">Modifica account <?php echo strtolower($_GET["accountType"]); ?></h4>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse px-3 pb-3 w-100">
                <ul class="mb-0">
                    <?php if ($_GET["accountType"] == "DOCENTE"): ?>
                        <li>
                            <label for="updateProfessorCode" class="text-left form-label">
                                Username
                            </label>
                        </li>
                        <li>
                            <select id="updateProfessorCode" name="username" onchange="getUpdateProfessorForm()" class="form-select rounded-pill w-lg-50" required>
                                <option value="">-- Seleziona --</option>
                                <?php foreach ($dbh->getProfessors() as $professor): ?>
                                    <option value="<?php echo $professor["professor"]; ?>"><?php echo $professor["professor"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                    <?php elseif($_GET["accountType"] == "ADMIN"): ?>
                        <li>
                            <label for="updateAdminCode" class="text-left form-label">
                                Username
                            </label>
                        </li>
                        <li>
                            <select id="updateAdminCode" name="username" onchange="getUpdateAdminForm()" class="form-select rounded-pill w-lg-50" required>
                                <option value="">-- Seleziona --</option>
                                <?php foreach ($dbh->getAdmins() as $admin): ?>
                                    <option value="<?php echo $admin["username"]; ?>"><?php echo $admin["username"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </li>
                    <div id="<?php echo $_GET["accountType"] == "DOCENTE" ? "updateProfessorForm" : "updateAdminForm"; ?>"></div>
                </ul>
                <input type="hidden" name="type" value="<?php echo $_GET["accountType"]; ?>" />
            </form>
        </div>
    </section>
</main>
