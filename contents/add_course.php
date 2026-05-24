<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <?php $selectedDegree = $templateParams["degrees"][0]; ?> <!-- TODO: fare in modo che si possa ottenere il corrente con js -->

    <section>
        <h2>Crea corso</h2>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="degree">
                        <h5>Corso di laurea</h5>
                    </label>
                </li>
                <li>
                   <select name="degree">
                        <option value="--" disabled selected hidden>-- Seleziona --</option>
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
                    <button type="submit" class="btn btn-primary" name="action" value="<?php echo ADMIN_ADD_COURSE; ?>">Crea corso</button>
                </li>
            </ul>
            <input type="hidden" name="degreeCode" value="<?php echo $selectedDegree["code"]; ?>" />
        </form>
    </section>
</main>