<?php $course = $dbh->getCourseInfo($_GET["course"])[0]; ?>
<main>
    <form action="handle_course.php?course=<?php echo $_GET["course"]; ?>" method="POST" enctype="multipart/form-data" class="w-75 mx-auto">
        <ul>
            <li>
                <label for="description" class="form-label">Descrizione</label>
            </li>
            <li>
                <input type="text" id="description" name="description" class="form-control rounded-pill" value="<?php echo $course['description']; ?>" />
            </li>
            <li>
                <label for="shortDescription" class="form-label">Descrizione breve</label>
            </li>
            <li>
                <input type="text" id="shortDescription" name="shortDescription" class="form-control rounded-pill" value="<?php echo $course['shortDescription']; ?>" />
            </li>
            <li>
                <label for="material" class="form-label">Materiale</label>
            </li>
            <li>
                <input type="text" id="material" name="material" class="form-control rounded-pill" value="<?php echo $course['material']; ?>" />
            </li>
            <div class="d-flex justify-content-end me-5 mt-4">
                <li>
                    <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                </li>
                <li>
                    <button class="btn btn-deepskyblue" name="action" type="submit">Salva</button>
                </li>
            </div>
        </ul>
    </form>
</main>
