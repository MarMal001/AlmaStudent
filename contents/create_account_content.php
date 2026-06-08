<main class="row align-items-center text-white text-center">
    <div class="col-xl col"></div>
    <div class="col-xl-3 col-5 bg-deepskyblue text-center text-white rounded-4 d-flex justify-content-center">
        <form action="create_account.php" method="post" class="pt-5">
            <h2 class="text-white">Crea un account</h2>
            <ul> 
                <li class="mt-2 mb-0 p-0">
                    <?php showMessage(); ?>
                </li>
                <li>
                    <label for="name" class="text-left form-label">
                        <h5>Nome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="name" name="name" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <label for="surname" class="text-left form-label">
                        <h5>Cognome</h5>
                    </label>
                </li>
                <li>
                    <input type="text" id="surname" name="surname" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <label for="username" class="text-left form-label">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <input type="email" id="username" name="username" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <label for="password" class="text-left form-label">
                        <h5>Password</h5>
                    </label>
                </li>
                <li>
                    <input type="password" id="password" name="password" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <input type="submit" class="btn btn-secondary-subtle" value="Crea account" />
                </li>
                <li class="mt-3">
                    <a href="login.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Hai già un account?</a>
                </li>
            </ul>
        </form>
    </div>
    <div class="col-xl col"></div>
</main>
