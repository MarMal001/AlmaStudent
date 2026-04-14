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
        
        <table class="table table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th id="day" scope="colgroup" colspan="3" class="fs-5"> < 18 Marzo 2026 ></th>
                </tr>
                <tr class="fs-6">
                    <th id="time" scope="col">Ore</th>
                    <th id="type" scope="col">Disponibilità</th>
                    <th id="reservations" scope="col">Prenotazioni</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <th id="900_915" scope="row" headers="time" class="text-center">9:00-9:15</th>
                        <td id="type_900_915" headers="type 900_915">Modalità: online o in presenza</td>
                        <td id="reservation_900_915" headers="reservations 900_915">Nessuna prenotazione</td>
                    </tr>
                    <tr>
                        <th id="915_930" scope="row" headers="time" class="text-center">9:15-9:30</th>
                        <td id="type_915_930" headers="type 915_930">Modalità: online</td>
                        <td id="reservation_915_930" headers="reservations 915_930">
                            <p>Prenotato</p>
                            <p>Studente: Mario Frini</p>
                        </td>
                    </tr>
                    <tr>
                        <th id="1500_1515" scope="row" headers="time" class="text-center">15:00-15:15</th>
                        <td id="type_1500_1515" headers="type 1500_1515">Modalità: presenza</td>
                        <td id="reservation_1500_1515" headers="reservations 1500_1515">Nessuna prenotazione</td>
                    </tr>
            </tbody>
        </table>
        
    </section>
</main>    