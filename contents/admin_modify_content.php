<main>
    <?php if (!isset($_GET["accountType"]))
        header("location: index.php");
    ?>

    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section>
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" class="pt-5">
            <h2>Crea un account <?php echo $_GET["accountType"] == "professor" ? "professore" : "admin"; ?></h2>
            <ul>
                <li>
                    <label for="name" class="text-left">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="name" name="name" />
                </li>
                <li>
                    <label for="surname" class="text-left">
                        <h5>Cognome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="surname" name="surname" />
                </li>
                <li>
                    <label for="username" class="text-left">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <input type="email" id="username" name="username" />
                </li>
                <li>
                    <label for="password" class="text-left">
                        <h5>Password</h5>
                    </label>
                </li>
                <li>
                    <input type="password" id="password" name="password" />
                </li>
                <?php if ($_GET["accountType"] == "professor"): ?>
                    <li>
                        <label for="department" class="text-left">
                            <h5>Dipartimento</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="department" name="department" />
                    </li>
                    <li>
                        <label for="seat" class="text-left">
                            <h5>Sede</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="seat" name="seat" />
                    </li>
                    <li>
                        <label for="infoReception" class="text-left">
                            <h5>Info ricevimento</h5>
                        </label>
                    </li>
                    <li>
                        <input type="text" id="infoReception" name="infoReception" />
                    </li>
                    <li>
                        <label for="profilePicture" class="text-left">
                            <h5>Immagine profilo</h5>
                        </label>
                    </li>
                    <li>
                        <input type="file" id="profilePicture" name="profilePicture" />
                    </li>
                <?php endif; ?>
                <li>
                    <input type="submit" class="btn btn-primary" value="Crea account" />
                </li>
            </ul>
            <input type="hidden" name="type" value="<?php echo $_GET["accountType"]; ?>" />
        </form>
    </section>
</main>