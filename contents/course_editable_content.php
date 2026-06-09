<?php $course = $dbh->getCourseInfo($_GET["course"])[0]; ?>
<main class="my-5">
    <div class="container-fluid w-auto m-2 p-0 mt-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3">
                <p class="m-0 p-2 fs-4">Modifica informazioni account</p>
            </div>
            <form action="handle_course.php?course=<?php echo $_GET["course"]; ?>" method="POST" enctype="multipart/form-data" class="w-100">
                <ul class="mb-0">
                    <li>
                        <label for="description" class="form-label">Descrizione</label>
                    </li>
                    <li>
                        <textarea id="description" name="description" class="form-control" maxlength="5000"><?php echo $course['description']; ?></textarea>
                    </li>
                    <li>
                        <label for="shortDescription" class="form-label">Descrizione breve</label>
                    </li>
                    <li>
                        <textarea id="shortDescription" name="shortDescription" class="form-control" maxlength="2000"><?php echo $course['shortDescription']; ?></textarea>
                    </li>
                    <li>
                        <label for="material" class="form-label">Materiale</label>
                    </li>
                    <li>
                        <textarea id="material" name="material" class="form-control" maxlength="1000"><?php echo $course['material']; ?></textarea>
                    </li>
                    <li class="d-flex justify-content-end mt-4">
                        <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        <button class="btn btn-deepskyblue" name="action" type="submit">Salva</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</main>
