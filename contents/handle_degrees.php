<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section>
        <h2>Crea corso di laurea</h2>
            <form action="handle_admin.php" method="POST" enctype="multipart/form-data">
            <ul>
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
                        <label for="years" class="text-left">
                            <h5>Anni</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="years" id="years">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </li>
                </div>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="department" class="text-left">
                            <h5>Dipartimento</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="department" id="deparment">
                            <option value="DISI">DISI</option>
                            <option value="DEI">DEI</option>
                            <option value="DIMEC">DIMEC</option>
                        </select>
                    </li>
                </div>
                <div class="d-flex align-content-stretch">
                    <li class="mt-2">
                        <label for="branch" class="text-left">
                            <h5>Sede</h5>
                        </label>
                    </li>
                    <li class="mt-2">
                        <select name="branch" id="branch">
                            <option value="Bologna">Bologna</option>
                            <option value="Cesena">Cesena</option>
                            <option value="Forli">Forli</option>
                        </select>
                    </li>
                </div>
                <li>
                    <label for="code" class="text-left">
                        <h5>Codice corso</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="code" name="code" />
                </li>
                <li>
                    <button type="submit" class="btn btn-primary" name="action" value="<?php echo ADMIN_ADD_DEGREE; ?>">Crea corso di lauera</button>
                </li>
            </ul>
        </form>
    </section>
</main>