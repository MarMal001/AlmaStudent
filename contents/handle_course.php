<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <?php $selectedDegree = $templateParams["degrees"][0]; ?> <!-- TODO: fare in modo che si possa ottenere il corrente con js -->
    <?php $selectedCourse["code"] = "00013"; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0 p-2">Aggiungi corso</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="degree">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree">
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["name"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <label for="name" class="text-left">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="name" name="name" />
                </li>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="year" class="text-left">
                            <h5>Anno</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="year" id="year">
                            <?php for ($i = 0; $i < $selectedDegree["nYears"]; $i++): ?>
                                <option value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></option>
                            <?php endfor; ?>
                        </select>
                    </li>
                    <li class="mt-2">
                        <label for="semester" class="text-left">
                            <h5>Semestre</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="semester" id="semester">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </li> 
                </div>
                <li>
                    <label for="professors">
                        <h5>Docente</h5>
                    </label>
                </li>
                <li>
                    <input type="text" name="professors" id="professors" />
                </li>
                <!-- TODO: Aggiungere i docenti dinamicamente in base alla richiesta -->
                <li>
                    <label for="code" class="text-left">
                        <h5>Codice corso</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="code" name="code" />
                </li>
                <li>
                    <button type="submit" class="btn btn-primary mt-3" name="action" value="<?php echo ADMIN_ADD_COURSE; ?>">Crea corso</button>
                </li>
            </ul>
            <input type="hidden" name="degreeCode" value="<?php echo $selectedDegree["code"]; ?>" />
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
                    <label for="degree">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree">
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["name"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <?php if ($selectedDegree != ""): ?>
                    <li>
                        <label for="code">
                            <h5>Corso</h5>
                        </label>
                    </li>
                    <li>
                        <select name="code">
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php for ($i = 0; $i < $dbh->getYearsDegree($selectedCourse); $i++): ?>
                                <?php foreach ($dbh->getCoursesByDegreeAndYear($selectedCourse, $i) as $course): ?>
                                    <option value="<?php echo $course["name"]; ?>"><?php echo $course["code"] . " - " . $course["name"]; ?></option>
                                <?php endforeach; ?>
                            <?php endfor; ?>
                        </select>
                    </li>
                    <?php if ($selectedCourse["code"] != ""): ?>
                        <li>
                            <label for="name" class="text-left">
                                <h5>Nome</h5>
                            </label>
                        </li>
                        <li>
                            <input type="text" id="name" name="name" value="<?php echo $selectedCourse["name"]; ?>" />
                        </li>
                        <div class="d-flex align-content-stretch">
                            <li class="mt-2">
                                <label for="year" class="text-left">
                                    <h5>Anno</h5>
                                </label>
                            </li>
                            <li class="mt-2">
                                <select name="year" id="year">
                                    <?php for ($i = 0; $i < $selectedDegree["nYears"]; $i++): ?>
                                        <option value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </li>
                            <li class="mt-2">
                                <label for="semester" class="text-left">
                                    <h5>Semestre</h5>
                                </label>
                            </li>
                            <li class="mt-2">
                                <select name="semester" id="semester">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </li> 
                        </div>
                        <li>
                            <label for="professors">
                                <h5>Docenti</h5>
                            </label>
                        </li>
                        <li>
                            <select name="profesors" id="professors">
                                <?php foreach($dbh->getProfessorsByCourse($selectedCourse["code"]) as $professor): ?>
                                    <option value="<?php echo $professor["code"]; ?>"><?php echo $professor["name"] . " " . $professor["surname"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                        <li>
                            <label for="code" class="text-left">
                                <h5>Codice corso</h5>
                            </label>
                        </li>
                        <li>
                            <input type="text" id="code" name="code" value="<?php echo $selectedCourse["code"]; ?>" />
                        </li>
                        <li>
                            <button type="submit" class="btn btn-primary mt-3" name="action" value="<?php echo ADMIN_MODIFY_COURSE; ?>">Modifica corso</button>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <input type="hidden" name="degreeCode" value="<?php echo $selectedDegree["code"]; ?>" />
        </form>
    </section>
            
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c3">
            <p class="m-0 p-2">Elimina corso</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>

        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c3" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="degree">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree">
                        <option value="" disabled selected hidden>-- Seleziona --</option>
                        <?php foreach ($templateParams["degrees"] as $degree): ?>
                            <option value="<?php echo $degree["name"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <?php if ($selectedDegree != ""): ?>
                    <li>
                        <label for="code">
                            <h5>Corso</h5>
                        </label>
                    </li>
                    <li>
                        <select name="code">
                            <option value="" disabled selected hidden>-- Seleziona --</option>
                            <?php for ($i = 0; $i < $dbh->getYearsDegree($selectedCourse); $i++): ?>
                                <?php foreach ($dbh->getCoursesByDegreeAndYear($selectedCourse, $i) as $course): ?>
                                    <option value="<?php echo $course["name"]; ?>"><?php echo $course["code"] . " - " . $course["name"]; ?></option>
                                <?php endforeach; ?>
                            <?php endfor; ?>
                        </select>
                    </li>
                    <li>
                        <button type="submit" class="btn btn-primary mt-3" name="action" value="<?php echo ADMIN_DELETE_COURSE; ?>">Elimina corso</button>
                    </li>
                <?php endif; ?>
            </ul>
            <input type="hidden" name="degreeCode" value="<?php echo $selectedDegree["code"]; ?>" />
        </form>
    </section>
</main>