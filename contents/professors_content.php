<main class="px-sm-5 py-5 px-3">
    <div>
        <label class="ms-3" for="degreeCode">Filtra per corso di laurea</label>
        <select name="courses" id="degreeCode" onchange="getProfessorsData()" class="form-select rounded-pill w-lg-25 mb-3">
            <option value="" selected>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["code"] ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="m-2" id="professors"></div>
</main>
