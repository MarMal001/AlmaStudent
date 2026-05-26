<main>
    <section>
        <label for="courses">Filtra per corso di laurea</label>
        <select name="courses" id="degreeCode" onchange="getCoursesData()">
            <option value="" disabled selected hidden>-- Seleziona --</option>
            <?php foreach ($templateParams["degrees"] as $degree): ?>
                <option value="<?php echo $degree["code"]; ?>"><?php echo $degree["code"] . " - " . $degree["name"] . " - " . $degree["campus"]; ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="m-2" id="courses"></section>
</main>    
