<main>  
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c0">
            <p class="m-0  p-2">Aggiungi disponibilità</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form id="c0" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <div>
                <label for="date">Data</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="time_hour">Fascia oraria da</label>
                <select name="time_hour">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
                <label for="time_minute">:</label>
                <select name="time_minute">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
                <label for="time_final_hour">a</label>
                <select name="time_final_hour">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
                <label for="time_final_minute">:</label>
                <select name="time_final_minute">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </div>
            <div>
                <label for="type">Modalità</label>
                <select name="type">
                    <option value="select" disabled selected hidden>--Seleziona--</option>
                    <option value="online">Online</option>
                    <option value="presence">Presenza</option>
                    <option value="presence">Online e in presenza</option>
                </select>
            </div>
            <div>                
                <label for="number_people">Numero posti</label>
                <input type="number" id="number_people" name="number_people" min="1" max="45">
            </div>
            <div class="d-flex justify-content-end m-2">
                <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                <button class="btn btn-primary ms-1" type="button">Aggiungi</button>
            </div>
        </form>
    </section>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0  p-2">Modifica disponibilità</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <div>
                <label for="date">Data</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="time">Fascia oraria da</label>
                <select name="time_hour">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
                <label for="time_minute">:</label>
                <select name="time_minute">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
                <label for="time_final_hour">a</label>
                <select name="time_final_hour">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
                <label for="time_final_minute">:</label>
                <select name="time_final_minute">
                    <option value="--" disabled selected hidden>--</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </div>
            <div>
                <label for="type">Modalità</label>
                <select name="type">
                    <option value="select" disabled selected hidden>--Seleziona--</option>
                    <option value="online">Online</option>
                    <option value="presence">Presenza</option>
                    <option value="presence">Online e in presenza</option>
                </select>
            </div>
            <div>                
                <label for="number_people">Numero posti</label>
                <input type="number" id="number_people" name="number_people" min="1" max="45">
            </div>
            <div class="d-flex justify-content-end m-2">
                <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                <button class="btn btn-white border-primary mx-1" type="submit">Elimina</button>
                <button class="btn btn-primary ms-1" type="button">Salva</button>
            </div>
        </form>
    </section>

    <section>
        <h2>Visualizza disponibilità</h2>
        
        <?php $date = "12 Aprile 2026"; ?>
        <table class="table table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th id="day" scope="colgroup" colspan="3" class="fs-5"> < <?php echo $date; ?> ></th>
                </tr>
                <tr class="fs-6">
                    <th id="time" scope="col">Ore</th>
                    <th id="type" scope="col">Disponibilità</th>
                    <th id="reservations" scope="col">Prenotazioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dbh->getReservationsOfProfessor("vittorio.ghini@unibo.it", "2026-04-12") as $reservation): ?>
                    <?php $timeRange = date("H:i", strtotime($reservation["startTime"])) . " - " . date("H:i", strtotime($reservation["endTime"])); ?>
                    <tr>
                        <th id="<?php echo $timeRange; ?>" scope="row" headers="time" class="text-center"><div><?php echo $timeRange; ?></div></th>
                        <td id="<?php echo "type_" . $timeRange; ?>" headers="type <?php echo $timeRange; ?>"><div>Modalità: <?php echo strtolower($reservation["mode"]); ?></div></td>
                        <td id="<?php echo "reservation_" . $timeRange; ?>" headers="reservations <?php echo $timeRange; ?>">
                            <?php if ($reservation["studentName"] != null): ?>
                                <div>Prenotato con studente: <?php echo $reservation["studentName"] . " " . $reservation["studentSurname"]; ?></div>
                                <div>Modalità: <?php echo strtolower($reservation["selectedMode"]); ?></div>
                            <?php else: ?>
                                <div>Nessuna prenotazione</div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </section>
</main>    