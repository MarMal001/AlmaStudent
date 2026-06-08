<main>
    <div class="container-fluid w-auto mx-2 mt-5 p-0 mb-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#c1">
                Aggiungi corso
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse px-3 pb-3 w-100 show">
                <ul class="mb-0 py-0">
                    <li>
                        <label for="addDegreeCode" class="form-label">
                            Corso di laurea
                        </label>
                    </li>
                    <li>
                        <select name="degree" id="addDegreeCode" onchange="getAddCourse()" class="form-select rounded-pill w-lg-50">
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php foreach ($templateParams["degrees"] as $degree): ?>
                                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                </ul>
                <ul class="my-0 pt-0" id="addCourse"></ul>
            </form>
        </div>
    </div>
    <div class="container-fluid w-auto m-2 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                Modifica corso
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse px-3 pb-3 w-100">
                <ul class="mb-0 pt-0">
                    <li>
                        <label for="updateDegreeCode" class="form-label">
                            Corso di laurea
                        </label>
                    </li>
                    <li>
                        <select name="degree" id="updateDegreeCode" onchange="getUpdateCoursesDropdown()" class="form-select rounded-pill w-lg-50">
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php foreach ($templateParams["degrees"] as $degree): ?>
                                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</main>
