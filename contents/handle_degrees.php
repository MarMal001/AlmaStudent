<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
                <h4 class="m-0 p-2">Crea corso di laurea</h4>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 show">
                <ul class="mb-0">
                    <li>
                        <label for="addName" class="text-left form-label">
                            <h5>Nome</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="addName" name="name" class="form-control rounded-pill" required />
                    </li>
                    <div class="d-flex align-content-stretch">
                        <li class="mt-2">
                            <label for="addYears" class="text-left form-label">
                                <h5>Anni</h5>
                            </label>
                        </li>
                        <li class="mt-2">
                            <select name="years" id="addYears" class="form-select rounded-pill mt-2 ms-2" required>
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex align-content-stretch">
                        <li class="mt-2">
                            <label for="addDepartment" class="text-left form-label">
                                <h5>Dipartimento</h5>
                            </label>
                        </li>
                        <li class="mt-2">
                            <select name="department" id="addDepartment" class="form-select rounded-pill mt-2 ms-2" required>
                                <option value="DISI">DISI</option>
                                <option value="DEI">DEI</option>
                                <option value="DIMEC">DIMEC</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex align-content-stretch">
                        <li class="mt-2">
                            <label for="addBranch" class="text-left form-label">
                                <h5>Sede</h5>
                            </label>
                        </li>
                        <li class="mt-2">
                            <select name="branch" id="addBranch" class="form-select rounded-pill mt-2 ms-2 me-3" required>
                                <option value="Bologna">Bologna</option>
                                <option value="Cesena">Cesena</option>
                                <option value="Forli">Forli</option>
                            </select>
                        </li>
                    </div>
                    <li>
                        <label for="addCode" class="text-left form-label">
                            <h5>Codice corso</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="addCode" name="code" class="form-control rounded-pill" required />
                    </li>
                    <li>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-deepskyblue mt-3 me-5" name="action" value="<?php echo ADMIN_ADD_DEGREE; ?>">Crea</button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                <h4 class="m-0 p-2">Modifica corso di laurea</h4>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100">
                <ul class="mb-0">
                    <li>
                        <label for="degreeCode" class="form-label">
                            <h5>Seleziona corso di laurea</h5>
                        </label>
                    </li>
                    <li>
                        <select name="code" id="degreeCode" onchange="getUpdateDegreesForm()" class="form-select rounded-pill w-25" required>
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php foreach ($templateParams["degrees"] as $degree): ?>
                                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <div id="formUpdate"></div>
                </ul>
            </form>
        </div>
    </section>
</main>
