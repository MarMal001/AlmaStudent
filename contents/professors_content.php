<main>
    <section>
        <label for="degreeCode">Filtra per corso di laurea</label>
        <select name="courses" id="degreeCode" onchange="getProfessorsData()" class="form-select w-25">
            <option value="" selected>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["code"] ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2" id="professors"></section>
</main>
