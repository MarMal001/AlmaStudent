<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0  p-2">Modifica dettagli corso</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <?php
            $course = $dbh->getCourseInfo($_GET["course"])[0];
        ?>

        <form action="handle_course.php?course=<?php echo $_GET["course"]; ?>" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="description">Descrizione</label>
                </li>
                <li>
                    <input type="text" id="description" name="description" value="<?php echo $course['description']; ?>" />
                </li>
                <li>
                    <label for="shortDescription">Descrizione breve</label>
                </li>
                <li>
                    <input type="text" id="shortDescription" name="shortDescription" value="<?php echo $course['shortDescription']; ?>" />
                </li>
                <li>
                    <label for="material">Materiale</label>
                </li>
                <li>
                    <input type="text" id="material" name="material" value="<?php echo $course['material']; ?>" />
                </li>
                <li class="m-2">
                    <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                    <button class="btn btn-primary ms-1" name="action" type="submit">Salva</button>
                </li>
            </ul>
        </form>
    </section>
</main>