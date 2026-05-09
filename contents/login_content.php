<main class="row align-items-center text-white text-center">
    <div class="col-xl col"></div>
    <div class="col-xl-3 col-5 bg-primary text-center text-white rounded-4">
        <div><?php if (isset($templateParams["loginError"])): ?>
            <?php echo $templateParams["loginError"]; ?>
        <?php endif ?></div>
        <form action="login.php" method="post" class="pt-5">
            <h2>Accedi al tuo account</h2>
            <ul>
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
                    <input type="submit" class="btn btn-outline-primary bg-white text-primary" value="Accedi" />
                </li>
                <li>
                    <a href="create_account.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Non hai un account?</a>
                </li>
            </ul>
        </form>
    </div>
    <div class="col-xl col"></div>
</main>