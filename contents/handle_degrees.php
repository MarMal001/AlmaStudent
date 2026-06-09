<main>
    <div class="container-fluid w-auto mx-3 p-0 mt-5 mb-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-lg-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between text-darkbluenavy align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#c1">
                Crea corso di laurea
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse px-3 pb-3 w-100 show">
                <ul class="mb-0 pt-0">
                    <li>
                        <label for="addName" class="text-left form-label">
                            Nome
                        </label>
                    </li>
                    <li>
                        <input type="text" id="addName" name="name" class="form-control rounded-pill" maxlength="100" required />
                    </li>
                    <li class="mt-2 d-flex">
                        <label for="addYears" class="text-left form-label">
                            Anni
                        </label>
                        <select name="years" id="addYears" class="form-select rounded-pill mt-2 ms-2 w-lg-25" required>
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </li>
                    <li class="mt-2 d-flex">
                        <label for="addDepartment" class="text-left form-label">
                            Dipartimento
                        </label>
                        <select name="department" id="addDepartment" class="form-select rounded-pill mt-2 ms-2 w-lg-25" required>
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <option value="DISI">DISI</option>
                            <option value="DEI">DEI</option>
                            <option value="DIMEC">DIMEC</option>
                        </select>
                    </li>
                    <li class="mt-2 d-flex">
                        <label for="addBranch" class="text-left form-label">
                            Sede
                        </label>
                        <select name="branch" id="addBranch" class="form-select rounded-pill mt-2 ms-2 me-3 w-lg-25" required>
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <option value="Bologna">Bologna</option>
                            <option value="Cesena">Cesena</option>
                            <option value="Forli">Forli</option>
                        </select>
                    </li>
                    <li>
                        <label for="addCode" class="text-left form-label">
                            Codice corso
                        </label>
                    </li>
                    <li>
                        <input type="text" id="addCode" name="code" class="form-control rounded-pill" maxlength="4" required />
                    </li>
                    <li>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-deepskyblue mt-3" name="action" value="<?php echo ADMIN_ADD_DEGREE; ?>">Crea</button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="container-fluid w-auto m-3 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-lg-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#c2">
                Modifica corso di laurea
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse px-3 pb-3 w-100">
                <ul class="mb-0 py-0">
                    <li>
                        <label for="degreeCode" class="form-label">
                            Seleziona corso di laurea
                        </label>
                    </li>
                    <li>
                        <select name="code" id="degreeCode" onchange="getUpdateDegreesForm()" class="form-select rounded-pill w-lg-50" required>
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php foreach ($templateParams["degrees"] as $degree): ?>
                                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                </ul>
                <ul class="mb-0 pt-0" id="formUpdate"></ul>
            </form>
        </div>
    </div>
</main>
