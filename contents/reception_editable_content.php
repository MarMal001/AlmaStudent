<main>
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <h2 class="w-75 mx-auto mb-3">Gestisci disponibilità</h2>
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
                <p class="m-0 p-2 text-darkbluenavy">Aggiungi disponibilità</p>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 show">
                <ul>
                    <li>
                        <label for="addReceptionDate" class="form-label">Data</label>
                    </li>
                    <li>
                        <input type="date" id="addReceptionDate" name="receptionDate" class="form-control rounded-pill w-25" required />
                    </li>
                    <div class="d-flex">
                        <li>
                            <label for="addStartTimeHour">Da</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="addStartTimeHour" name="startTimeHour" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
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
                            <label for="addStartTimeMinute">:</label>
                        </li>
                        <li class="mt-3 ms-1">
                            <select id="addStartTimeMinute" name="startTimeMinute" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex">
                        <li>
                            <label for="addEndTimeHour">a</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="addEndTimeHour" name="endTimeHour" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
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
                            <label for="addEndTimeMinute">:</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="addEndTimeMinute" name="endTimeMinute" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex">
                        <li>
                            <label for="addMode">Modalità</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="addMode" name="mode" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--Seleziona--</option>
                                <option value="online">Online</option>
                                <option value="presence">Presenza</option>
                                <option value="online_presence">Online e in presenza</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <li>
                            <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        </li>
                        <li>
                            <button class="btn btn-deepskyblue ms-1" name="action" value="<?php echo RECEPTION_ACTION_ADD; ?>" type="submit">Aggiungi</button>
                        </li>
                    </div>
                </ul>
            </form>
        </div>
    </section>
    <section class="container-fluid w-auto m-2 p-0 my-4">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <div class="d-flex justify-content-between align-items-center fw-bold p-3" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                <p class="m-0 p-2 text-darkbluenavy">Modifica disponibilità</p>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </div>
            <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100">
                <ul>
                    <li>
                        <label for="updateReceptionDate">Data</label>
                    </li>
                    <li>
                        <input type="date" id="updateReceptionDate" name="receptionDate" class="form-control rounded-pill w-25" required />
                    </li>
                    <div class="d-flex">
                        <li>
                            <label for="updateStartTimeHour">Da</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="udpateStartTimeHour" name="startTimeHour" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
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
                            <label for="updateStartTimeMinute">:</label>
                        </li>
                        <li class="mt-3 ms-1">
                            <select id="updateStartTimeMinute" name="startTimeMinute" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex">
                        <li>
                            <label for="updateEndTimeHour">a</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="updateEndTimeHour" name="endTimeHour" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
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
                            <label for="updateEndTimeMinute">:</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="updateEndTimeMinute" name="endTimeMinute" class="form-select rounded-pill" required>
                                <option value="" disabled selected hidden>--</option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex">
                        <li>
                            <label for="updateMode">Modalità</label>
                        </li>
                        <li class="mt-3 mx-1">
                            <select id="updateMode" name="mode" class="form-select rounded-pill">
                                <option value="" disabled selected hidden>--Seleziona--</option>
                                <option value="online">Online</option>
                                <option value="presence">Presenza</option>
                                <option value="online_presence">Online e in presenza</option>
                            </select>
                        </li>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <li>
                            <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        </li>
                        <li>
                            <button class="btn btn-secondary-subtle mx-1" name="action" value="<?php echo RECEPTION_ACTION_DELETE; ?>" type="submit">Elimina</button>
                        </li>
                        <li>
                            <button class="btn btn-deepskyblue ms-1" name="action" value="<?php echo RECEPTION_ACTION_MODIFY; ?>" type="submit">Salva</button>
                        </li>
                    </div>
                </ul>
            </form>
        </div>
    </section>
    <section>
        <h2 class="w-75 mx-auto mb-3">Visualizza disponibilità</h2>
        <table class="table table-bordered w-75 mx-auto" id="receptionTable"></table>
    </section>
    <input type="hidden" id="professor" value=<?php echo $user;?> />
</main>
