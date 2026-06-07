<main class="p-5">
    <section>
        <label class="ms-3" for="degreeCode">Filtra per corso di laurea</label>
        <select name="courses" id="degreeCode" onchange="getCoursesData()" class="form-select rounded-pill w-lg-25 mb-3">
            <option value="" selected>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2" id="courses"></section>
</main>
