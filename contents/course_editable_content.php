<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>
    
    <?php
        $course = $dbh->getCourseInfo($_GET["course"])[0];
    ?>

    <form action="handle_course.php?course=<?php echo $_GET["course"]; ?>" method="POST" enctype="multipart/form-data">
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
            <div class="d-flex m-2">
                <li>
                    <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                </li>
                <li>
                    <button class="btn btn-primary ms-1" name="action" type="submit">Salva</button>
                </li>
            </div>
        </ul>
    </form>
</main>
