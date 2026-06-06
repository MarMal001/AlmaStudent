<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0 p-2">Crea corso di laurea</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>

        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="addName" class="text-left">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="addName" name="name" required />
                </li>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="addYears" class="text-left">
                            <h5>Anni</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="years" id="addYears" class="form-select mt-2 ms-2" required>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </li>
                </div>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="addDepartment" class="text-left">
                            <h5>Dipartimento</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="department" id="addDepartment" class="form-select mt-2 ms-2" required>
                            <option value="DISI">DISI</option>
                            <option value="DEI">DEI</option>
                            <option value="DIMEC">DIMEC</option>
                        </select>
                    </li>
                </div>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="addBranch" class="text-left">
                            <h5>Sede</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="branch" id="addBranch" class="form-select mt-2 ms-2 me-3" required>
                            <option value="Bologna">Bologna</option>
                            <option value="Cesena">Cesena</option>
                            <option value="Forli">Forli</option>
                        </select>
                    </li>
                </div>
                <li>
                    <label for="addCode" class="text-left">
                        <h5>Codice corso</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="addCode" name="code" required />
                </li>
                <li>
                    <button type="submit" class="btn btn-primary mt-3" name="action" value="<?php echo ADMIN_ADD_DEGREE; ?>">Crea</button>
                </li>
            </ul>
        </form>
    </section>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
            <p class="m-0 p-2">Modifica corso di laurea</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="degreeCode">Seleziona corso di laurea</label>
                </li>
                <li>
                    <select name="code" id="degreeCode" onchange="getUpdateDegreesForm()" class="form-select w-25" required>
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <div id="formUpdate"></div>
            </ul>
        </form>
    </section>
</main>
