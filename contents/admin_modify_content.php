<main>
    <?php if (isset($templateParams["message"])): ?>
        <section>
            <?php echo $templateParams["message"]; ?>
        </section>
    <?php endif; ?>

    <section>
        <form action="handle_admin.php" method="POST" enctype="multipart/form-data" id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <h2>Crea un account <?php echo $_GET["type"]; ?></h2>
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
                <li>
                    <input type="submit" class="btn btn-outline-primary bg-white text-primary" value="Crea account" />
                </li>
            </ul>
            <input type="hidden" name="type" value="<?php echo $_GET["account_type"]; ?>" />
        </form>
    </section>
</main>