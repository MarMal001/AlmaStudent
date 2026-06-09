<main class="mt-5">
    <div class="w-75 mb-3 mx-auto"><?php showMessage(); ?></div>
    <div class="container-fluid w-auto m-2 p-0 mb-4">
        <h2 class="w-75 mx-auto mb-3">Gestisci disponibilità</h2>
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#c1">
                <span class="m-0 p-2 fs-4 text-darkbluenavy">Aggiungi disponibilità</span>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 show">
                <ul class="mb-0 pt-0">
                    <li>
                        <label for="addReceptionDate" class="form-label">Data</label>
                    </li>
                    <li>
                        <input type="date" id="addReceptionDate" name="receptionDate" class="form-control rounded-pill w-lg-25" required />
                    </li>
                    <li class="d-flex mt-3">
                        <label for="addStartTimeHour">Da</label>
                        <select id="addStartTimeHour" name="startTimeHour" class="form-select rounded-pill mt-2 mx-2 w-lg-25" required>
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
                        <label for="addStartTimeMinute">:</label>
                        <select id="addStartTimeMinute" name="startTimeMinute" class="form-select rounded-pill mt-2 mx-2 w-lg-25" required>
                            <option value="" disabled selected hidden>--</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </li>
                    <li class="d-flex mt-3">
                        <label for="addEndTimeHour">a</label>
                        <select id="addEndTimeHour" name="endTimeHour" class="form-select rounded-pill mt-2 mx-2 w-lg-25" required>
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
                        <label for="addEndTimeMinute">:</label>
                        <select id="addEndTimeMinute" name="endTimeMinute" class="form-select rounded-pill mt-2 mx-2 w-lg-25" required>
                            <option value="" disabled selected hidden>--</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </li>
                    <li class="d-flex mt-3">
                        <label for="addMode">Modalità</label>
                        <select id="addMode" name="mode" class="form-select rounded-pill mt-2 mx-2 w-lg-25" required>
                            <option value="" disabled selected hidden>--Seleziona--</option>
                            <option value="online">Online</option>
                            <option value="presence">Presenza</option>
                            <option value="online_presence">Online e in presenza</option>
                        </select>
                    </li>
                    <li class="d-flex justify-content-end mt-4">
                        <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        <button class="btn btn-deepskyblue ms-1" name="action" value="<?php echo RECEPTION_ACTION_ADD; ?>" type="submit">Aggiungi</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="container-fluid w-auto m-2 p-0 mt-4 mb-5">
        <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-75 mx-auto">
            <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#c2">
                <span class="m-0 p-2 fs-4 text-darkbluenavy">Modifica disponibilità</span>
                <i class="fa-solid fa-angle-down me-1 mt-1" style="color: rgb(30, 48, 80);"></i>
            </button>
            <form action="handle_reception.php" method="POST" enctype="multipart/form-data" id="c2" class="collapse p-3 w-100">
                <ul class="mb-0 pt-0">
                    <li>
                        <label for="updateReceptionDate">Data</label>
                    </li>
                    <li>
                        <input type="date" id="updateReceptionDate" name="receptionDate" class="form-control rounded-pill w-lg-25" required />
                    </li>
                    <li class="d-flex mt-3">
                        <label for="updateStartTimeHour">Da</label>
                        <select id="updateStartTimeHour" name="startTimeHour" class="form-select mt-2 mx-2 w-lg-25 rounded-pill" required>
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
                        <label for="updateStartTimeMinute">:</label>
                        <select id="updateStartTimeMinute" name="startTimeMinute" class="form-select mt-2 mx-2 w-lg-25 rounded-pill" required>
                            <option value="" disabled selected hidden>--</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </li>
                    <li class="d-flex mt-3">
                        <label for="updateEndTimeHour">a</label>
                        <select id="updateEndTimeHour" name="endTimeHour" class="form-select mt-2 mx-2 w-lg-25 rounded-pill" required>
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
                        <label for="updateEndTimeMinute">:</label>
                        <select id="updateEndTimeMinute" name="endTimeMinute" class="form-select mt-2 mx-2 w-lg-25 rounded-pill" required>
                            <option value="" disabled selected hidden>--</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </li>
                    <li class="d-flex mt-3">
                        <label for="updateMode">Modalità</label>
                        <select id="updateMode" name="mode" class="form-select mt-2 mx-2 w-lg-25 rounded-pill">
                            <option value="" disabled selected hidden>--Seleziona--</option>
                            <option value="online">Online</option>
                            <option value="presence">Presenza</option>
                            <option value="online_presence">Online e in presenza</option>
                        </select>
                    </li>
                    <li class="d-flex justify-content-end mt-4 mx-2">
                        <button class="btn btn-secondary-subtle me-1" type="reset">Annulla</button>
                        <button class="btn btn-secondary-subtle mx-1" name="action" value="<?php echo RECEPTION_ACTION_DELETE; ?>" type="submit">Elimina</button>
                        <button class="btn btn-deepskyblue ms-1" name="action" value="<?php echo RECEPTION_ACTION_MODIFY; ?>" type="submit">Salva</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <section class="mb-5">
        <h2 class="w-75 mx-auto mb-3">Visualizza disponibilità</h2>
        <table class="table table-bordered w-75 mx-auto" id="receptionTable"></table>
    </section>
    <input type="hidden" id="professor" value=<?php echo $user;?> />
</main>
