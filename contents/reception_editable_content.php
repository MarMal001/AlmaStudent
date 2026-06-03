<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c0">
            <p class="m-0 p-2">Aggiungi disponibilità</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c0" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="receptionDate">Data</label>
                </li>
                <li>
                    <input type="date" id="receptionDate" name="receptionDate" />
                </li>
                <li>
                    <label for="startTimeHour">Fascia oraria da</label>
                </li>
                <li>
                    <select name="startTimeHour">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="09">9</option>
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
                </li>
                <li>
                    <label for="startTimeMinute">:</label>
                </li>
                <li>
                    <select name="startTimeMinute">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </li>
                <li>
                    <label for="endTimeHour">a</label>
                </li>
                <li>
                    <select name="endTimeHour">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="09">9</option>
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
                </li>
                <li>
                    <label for="endTimeMinute">:</label>
                </li>
                <li>
                    <select name="endTimeMinute">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </li>
                <li>
                    <label for="mode">Modalità</label>
                </li>
                <li>
                    <select name="mode">
                        <option value="select" disabled selected hidden>--Seleziona--</option>
                        <option value="online">Online</option>
                        <option value="presence">Presenza</option>
                        <option value="online_presence">Online e in presenza</option>
                    </select>
                </li>
                <div class="d-flex m-2">
                    <li>
                        <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                    </li>
                    <li>
                        <button class="btn btn-primary ms-1" name="action" value="<?php echo RECEPTION_ACTION_ADD; ?>" type="submit">Aggiungi</button>
                    </li>
                </div>
            </ul>
        </form>
    </section>

    <section class="container-fluid w-auto m-2 p-0 my-4">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <p class="m-0  p-2">Modifica disponibilità</p>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <ul>
                <li>
                    <label for="receptionDate">Data</label>
                    <input type="date" id="receptionDate" name="receptionDate" />
                </li>
                <li>
                    <label for="startTimeHour">Fascia oraria da</label>
                </li>
                <li>
                    <select name="startTimeHour">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="09">9</option>
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
                </li>
                <li>
                    <label for="startTimeMinute">:</label>
                </li>
                <li>
                    <select name="startTimeMinute">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </li>
                <li>
                    <label for="endTimeHour">a</label>
                </li>
                <li>
                    <select name="endTimeHour">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="09">9</option>
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
                </li>
                <li>
                    <label for="endTimeMinute">:</label>
                </li>
                <li>
                    <select name="endTimeMinute">
                        <option value="--" disabled selected hidden>--</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </li>
                <li>
                    <label for="mode">Modalità</label>
                </li>
                    <select name="mode">
                        <option value="select" disabled selected hidden>--Seleziona--</option>
                        <option value="online">Online</option>
                        <option value="presence">Presenza</option>
                        <option value="online_presence">Online e in presenza</option>
                    </select>
                </li>
                <div class="d-flex m-2">
                    <li>
                        <button class="btn btn-white border-primary me-1" type="reset">Annulla</button>
                    </li>
                    <li>
                        <button class="btn btn-white border-primary mx-1" name="action" value="<?php echo RECEPTION_ACTION_DELETE; ?>" type="submit">Elimina</button>
                    </li>
                    <li>
                        <button class="btn btn-primary ms-1" name="action" value="<?php echo RECEPTION_ACTION_MODIFY; ?>" type="submit">Salva</button>
                    </li>
                </div>
            </ul>
        </form>
    </section>

    <section>
        <h2>Visualizza disponibilità</h2>
        <table class="table table-bordered" id="receptionTable"></table>
    </section>
    <input type="hidden" id="professor" value=<?php echo $user;?> />
</main>    
