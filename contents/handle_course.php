<main>
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0 p-2">Aggiungi corso</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="addDegreeCode">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree" id="addDegreeCode" onchange="getAddCourse()" class="form-select w-25">
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <div id="addCourse"></div>
            </ul>
        </form>
    </section>
        
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
            <p class="m-0 p-2">Modifica corso</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>

        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="updateDegreeCode">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree" id="updateDegreeCode" onchange="getUpdateCoursesDropdown()" class="form-select w-25">
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <div id="coursesDropdown"></div>
            </ul>
        </form>
    </section>
</main>
