<?php $course = $dbh->getCourseInfo($_GET["course"])[0]; ?>
<main class="my-5">
    <section class="container-fluid w-auto m-2 p-0 mt-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3">
                <h4 class="m-0 p-2">Modifica informazioni account</h4>
            </div>
            <form action="handle_course.php?course=<?php echo $_GET["course"]; ?>" method="POST" enctype="multipart/form-data" class="w-100">
                <ul class="mb-0">
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
                        <textarea type="text" id="material" name="material" class="form-control" value="<?php echo $course['material']; ?>" maxlength="1000"></textarea>
                    </li>
                    <div class="d-flex justify-content-end mt-4">
                        <li>
                            <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        </li>
                        <li>
                            <button class="btn btn-deepskyblue" name="action" type="submit">Salva</button>
                        </li>
                    </div>
                </ul>
            </form>
        </div>
    </section>
</main>
