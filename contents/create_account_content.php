<main class="row align-items-center text-white text-center">
    <div class="col-xl col"></div>
    <div class="col-xl-3 col-5 bg-primary text-center text-white rounded-4">
        <div><?php if (isset($templateParams["createAccountError"])): ?>
            <?php echo $templateParams["createAccountError"]; ?>
        <?php endif ?></div>
        <form action="create_account.php" method="post" class="pt-5">
            <h2>Crea un account</h2>
            <ul>
                <li>
                    <label for="name" class="text-left">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="name" name="name">
                </li>
                <li>
                    <label for="surname" class="text-left">
                        <h5>Cognome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="surname" name="surname">
                </li>
                <li>
                    <label for="studentId" class="text-left">
                        <h5>Matricola</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="studentId" name="studentId">
                </li>
                <li>
                    <label for="username" class="text-left">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <input type="email" id="username" name="username">
                </li>
                <li>
                    <label for="password" class="text-left">
                        <h5>Password</h5>
                    </label>
                </li>
                <li>
                    <input type="password" id="password" name="password">
                </li>
                <li>
                    <input type="submit" class="btn btn-outline-primary bg-white text-primary" value="Crea account">
                </li>
            </ul>
        </form>
        <form action="login.php" method="post">
            <ul>
                <li>
                    <input type="submit" value="Hai già un account?">
                </li>
            </ul>
        </form>
    </div>
    <div class="col-xl col"></div>
</main>